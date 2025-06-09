@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Detail Penjualan</h5>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th width="200">ID Pesanan</th>
                                <td>{{ $penjualan->id_pesanan }}</td>
                            </tr>
                            <tr>
                                <th>Customer</th>
                                <td>{{ $penjualan->customer->name }}</td>
                            </tr>
                            <tr>
                                <th>Quantity</th>
                                <td>{{ $penjualan->quantity }}</td>
                            </tr>
                            <tr>
                                <th>Price Total</th>
                                <td>Rp {{ number_format($penjualan->price_total, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th>Metode Pengambilan</th>
                                <td>{{ $penjualan->metode_pengambilan }}</td>
                            </tr>
                            <tr>
                                <th>Status Pembayaran</th>
                                <td>
                                    <span class="badge bg-{{ $penjualan->status_pembayaran === 'Selesai' ? 'success' : ($penjualan->status_pembayaran === 'Pending' ? 'warning' : 'danger') }}">
                                        {{ $penjualan->status_pembayaran }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th>Tanggal</th>
                                <td>{{ $penjualan->tanggal->format('d/m/Y') }}</td>
                            </tr>
                            <tr>
                                <th>Dibuat Pada</th>
                                <td>{{ $penjualan->created_at->format('d/m/Y H:i:s') }}</td>
                            </tr>
                            <tr>
                                <th>Terakhir Diupdate</th>
                                <td>{{ $penjualan->updated_at->format('d/m/Y H:i:s') }}</td>
                            </tr>
                        </table>
                    </div>

                    <div class="mt-3">
                        <a href="{{ route('penjualan.edit', $penjualan) }}" class="btn btn-warning">Edit</a>
                        <a href="{{ route('penjualan.index') }}" class="btn btn-secondary">Kembali</a>
                        <a href="{{ route('penjualan.invoice', $penjualan->id) }}" class="btn btn-info" target="_blank">Lihat Invoice</a>
                        <a href="{{ route('penjualan.download-invoice', $penjualan->id) }}" class="btn btn-success" target="_blank">Download Invoice</a>
                        <form action="{{ route('penjualan.destroy', $penjualan) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
