<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Penjualan::with('customer')->orderByDesc('tanggal')->paginate(10);
        return view('invoice.index', compact('invoices'));
    }

    public function show($id)
    {
        $invoice = Penjualan::with('customer')->findOrFail($id);
        return view('invoice.show', compact('invoice'));
    }
}
