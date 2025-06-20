<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $query = Transaksi::with('details')
            ->orderBy('created_at', 'desc');
            
        // Filter by date range if provided
        if (request('start_date') && request('end_date')) {
            $startDate = Carbon::parse(request('start_date'))->startOfDay();
            $endDate = Carbon::parse(request('end_date'))->endOfDay();
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }
        
        $invoices = $query->paginate(10);
        
        return view('invoice.index', compact('invoices'));
    }

    public function show($id)
    {
        $invoice = Transaksi::with('details')->findOrFail($id);
        return view('invoice.show', compact('invoice'));
    }
    
    public function print($id)
    {
        $invoice = Transaksi::with('details')->findOrFail($id);
        return view('invoice.print', compact('invoice'));
    }
    
    /**
     * Get invoice content for modal display
     */
    public function showContent($id)
    {
        $invoice = Transaksi::with('details')->findOrFail($id);
        return view('invoice.show-content', compact('invoice'))->render();
    }
    
    /**
     * Get invoice content for printing
     */
    public function printContent($id)
    {
        $invoice = Transaksi::with('details')->findOrFail($id);
        return view('invoice.print', compact('invoice'))->render();
    }
}
