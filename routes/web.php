<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\BarangServiceController;
use App\Http\Controllers\BarangCustomController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\InvoiceController;

// Home route
use App\Http\Controllers\DashboardController;

Route::get('/', [DashboardController::class, 'index']);

// Authentication Routes
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', function (\Illuminate\Http\Request $request) {
    $credentials = $request->only('email', 'password');
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect('/');
    }
    return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
});

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/password/request', function () {
    return view('password-request');
})->name('password.request');

// Transaksi Routes - Hanya bisa diakses setelah login
Route::middleware(['auth'])->group(function () {
    // Transaksi Routes
    Route::resource('transaksi', TransaksiController::class);
    
    // Barang Service Routes
    Route::resource('barang-service', BarangServiceController::class);
    Route::get('/api/barang-service', [BarangServiceController::class, 'search'])->name('api.barang-service.search');

    // Barang Custom Routes
    Route::resource('barang-custom', BarangCustomController::class);
    Route::patch('barang-custom/{barangCustom}/status', [BarangCustomController::class, 'updateStatus'])
        ->name('barang-custom.update-status');

    // Penjualan Routes
    Route::resource('penjualan', PenjualanController::class);
    Route::get('penjualan/{penjualan}/invoice', [PenjualanController::class, 'invoice'])->name('penjualan.invoice');
    Route::get('penjualan/{penjualan}/download-invoice', [PenjualanController::class, 'downloadInvoice'])->name('penjualan.download-invoice');

    // Invoice Routes
    Route::get('/invoice', [App\Http\Controllers\InvoiceController::class, 'index'])->name('invoice.index');
    Route::get('/invoice/{invoice}', [InvoiceController::class, 'show'])->name('invoice.show');
    Route::get('/invoice/{invoice}/print', [InvoiceController::class, 'print'])->name('invoice.print');

    // AJAX endpoints for modal content
    Route::get('/invoice/{invoice}/show-content', [InvoiceController::class, 'showContent'])->name('invoice.show-content');
    Route::get('/invoice/{invoice}/print-content', [InvoiceController::class, 'printContent'])->name('invoice.print-content');

    // AJAX: Cari barang by ID
    Route::get('ajax/cari-barang', [TransaksiController::class, 'cariBarang'])->name('ajax.cari-barang');

    // Profile Routes
    Route::get('/profile/edit', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});
