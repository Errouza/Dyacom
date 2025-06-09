@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Edit Penjualan</h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('penjualan.update', $penjualan) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="id_pesanan">ID Pesanan</label>
                            <input type="text" class="form-control @error('id_pesanan') is-invalid @enderror" id="id_pesanan" name="id_pesanan" value="{{ old('id_pesanan', $penjualan->id_pesanan) }}" required>
                            @error('id_pesanan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="id_customer">Customer</label>
                            <select class="form-control @error('id_customer') is-invalid @enderror" id="id_customer" name="id_customer" required>
                                <option value="">Pilih Customer</option>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}" {{ old('id_customer', $penjualan->id_customer) == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_customer')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="quantity">Quantity</label>
                            <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" value="{{ old('quantity', $penjualan->quantity) }}" required min="1">
                            @error('quantity')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="price_total">Price Total</label>
                            <input type="number" step="0.01" class="form-control @error('price_total') is-invalid @enderror" id="price_total" name="price_total" value="{{ old('price_total', $penjualan->price_total) }}" required min="0">
                            @error('price_total')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="metode_pengambilan">Metode Pengambilan</label>
                            <select class="form-control @error('metode_pengambilan') is-invalid @enderror" id="metode_pengambilan" name="metode_pengambilan" required>
                                <option value="">Pilih Metode</option>
                                <option value="Pickup" {{ old('metode_pengambilan', $penjualan->metode_pengambilan) == 'Pickup' ? 'selected' : '' }}>Pickup</option>
                                <option value="Delivery" {{ old('metode_pengambilan', $penjualan->metode_pengambilan) == 'Delivery' ? 'selected' : '' }}>Delivery</option>
                            </select>
                            @error('metode_pengambilan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="status_pembayaran">Status Pembayaran</label>
                            <select class="form-control @error('status_pembayaran') is-invalid @enderror" id="status_pembayaran" name="status_pembayaran" required>
                                <option value="">Pilih Status</option>
                                <option value="Pending" {{ old('status_pembayaran', $penjualan->status_pembayaran) == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Selesai" {{ old('status_pembayaran', $penjualan->status_pembayaran) == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="Dibatalkan" {{ old('status_pembayaran', $penjualan->status_pembayaran) == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                            </select>
                            @error('status_pembayaran')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal', $penjualan->tanggal->format('Y-m-d')) }}" required>
                            @error('tanggal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('penjualan.index') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
