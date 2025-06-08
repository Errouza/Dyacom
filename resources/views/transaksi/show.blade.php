<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-semibold">Detail Transaksi</h2>
                        <a href="{{ route('transaksi.index') }}" class="text-blue-600 hover:text-blue-900">Kembali ke Daftar</a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Produk</h3>
                            <dl class="grid grid-cols-1 gap-4">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">ID Barang</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $transaksi->id_barang }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Nama Produk</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $transaksi->product }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Harga</dt>
                                    <dd class="mt-1 text-sm text-gray-900">Rp {{ number_format($transaksi->harga, 0, ',', '.') }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Jumlah</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $transaksi->quantity }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Sub Total</dt>
                                    <dd class="mt-1 text-sm text-gray-900">Rp {{ number_format($transaksi->sub_total, 0, ',', '.') }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Total</dt>
                                    <dd class="mt-1 text-sm text-gray-900 font-bold">Rp {{ number_format($transaksi->total, 0, ',', '.') }}</dd>
                                </div>
                            </dl>
                        </div>

                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Pembeli</h3>
                            <dl class="grid grid-cols-1 gap-4">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Nama Pembeli</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $transaksi->buyer_name }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Email</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $transaksi->buyer_email ?? '-' }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">No. Telepon</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $transaksi->buyer_phone ?? '-' }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Tanggal Transaksi</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $transaksi->created_at->format('d/m/Y H:i') }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <div class="mt-8 flex items-center justify-end space-x-4">
                        <a href="{{ route('transaksi.edit', $transaksi) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                            Edit Transaksi
                        </a>
                        <form action="{{ route('transaksi.destroy', $transaksi) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" 
                                onclick="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')">
                                Hapus Transaksi
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
