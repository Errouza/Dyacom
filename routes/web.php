<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\BarangServiceController;
use App\Http\Controllers\BarangCustomController;

// Home route
Route::get('/', function () {
    return view('welcome');
});

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

    // Barang Custom Routes
    Route::resource('barang-custom', BarangCustomController::class);
    Route::patch('barang-custom/{barangCustom}/status', [BarangCustomController::class, 'updateStatus'])
        ->name('barang-custom.update-status');
});
