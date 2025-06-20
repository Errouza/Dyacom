<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Header -->
                    <div class="mb-6">
                        <h2 class="text-2xl font-semibold">Riwayat Pesanan</h2>
                        
                        <!-- Filter Tanggal -->
                        <form action="{{ route('penjualan.index') }}" method="GET" class="mt-4">
                            <div class="flex gap-4 items-end">
                                <div class="flex-1 max-w-xs">
                                    <label for="start_date" class="block text-sm font-medium text-gray-700">Tanggal Dari</label>
                                    <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>
                                <div class="flex-1 max-w-xs">
                                    <label for="end_date" class="block text-sm font-medium text-gray-700">Sampai</label>
                                    <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>
                                <button type="submit" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                                    Cari
                                </button>
                                @if(request()->has('start_date') || request()->has('end_date'))
                                    <a href="{{ route('penjualan.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                                        Reset
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>

                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Nama Pembeli</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">ID Transaksi</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Total Item</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Total Harga</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($penjualans as $penjualan)
                                    <tr class="hover:bg-gray-50 cursor-pointer" onclick="toggleDetails('details-{{ $loop->index }}')">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ ($penjualans->currentPage() - 1) * $penjualans->perPage() + $loop->iteration }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $penjualan->created_at->format('d/m/Y H:i') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $penjualan->buyer_name ?? 'Tamu' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#{{ str_pad($penjualan->id, 6, '0', STR_PAD_LEFT) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $penjualan->details->sum('quantity') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Rp {{ number_format($penjualan->total, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Lunas
                                            </span>
                                        </td>
                                        <!-- Tombol Aksi -->
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <button type="button" 
                                                    class="text-blue-600 hover:text-blue-900 focus:outline-none" 
                                                    onclick="event.stopPropagation(); toggleDetails('details-{{ $loop->index }}')"
                                                    title="Lihat Detail">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                    
                                    <!-- Detail Transaksi -->
                                    <tr id="details-{{ $loop->index }}" class="hidden bg-gray-50">
                                        <td colspan="8" class="px-6 py-4">
                                            <div class="ml-8">
                                                <div class="grid grid-cols-2 gap-4 mb-4">
                                                    <div>
                                                        <h4 class="font-medium text-gray-900">Informasi Pembeli</h4>
                                                        <p class="text-sm text-gray-500">{{ $penjualan->buyer_name ?? 'Tamu' }}</p>
                                                        @if($penjualan->buyer_phone)
                                                            <p class="text-sm text-gray-500">{{ $penjualan->buyer_phone }}</p>
                                                        @endif
                                                        @if($penjualan->buyer_email)
                                                            <p class="text-sm text-gray-500">{{ $penjualan->buyer_email }}</p>
                                                        @endif
                                                    </div>
                                                    <div class="text-right">
                                                        <h4 class="font-medium text-gray-900">Total Pembayaran</h4>
                                                        <p class="text-2xl font-bold text-gray-900">Rp {{ number_format($penjualan->total, 0, ',', '.') }}</p>
                                                        <p class="text-sm text-gray-500">Dibayar: Rp {{ number_format($penjualan->bayar, 0, ',', '.') }}</p>
                                                        <p class="text-sm text-gray-500">Kembalian: Rp {{ number_format($penjualan->kembalian, 0, ',', '.') }}</p>
                                                    </div>
                                                </div>
                                                
                                                <h4 class="font-medium text-gray-900 mb-2">Daftar Barang:</h4>
                                                @if($penjualan->details->count() > 0)
                                                    <table class="min-w-full divide-y divide-gray-200 mt-2">
                                                        <thead class="bg-gray-100">
                                                            <tr>
                                                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk</th>
                                                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga Satuan</th>
                                                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Qty</th>
                                                                <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Subtotal</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="bg-white divide-y divide-gray-200">
                                                            @foreach($penjualan->details as $detail)
                                                                <tr>
                                                                    <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">{{ $detail->product }}</td>
                                                                    <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">Rp {{ number_format($detail->harga, 0, ',', '.') }}</td>
                                                                    <td class="px-4 py-2 whitespace-nowrap text-sm text-center text-gray-900">{{ $detail->quantity }}</td>
                                                                    <td class="px-4 py-2 whitespace-nowrap text-sm text-right text-gray-900">Rp {{ number_format($detail->sub_total, 0, ',', '.') }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                @else
                                                    <p class="text-sm text-gray-500">Tidak ada detail transaksi tersedia.</p>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                                            Tidak ada data penjualan
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $penjualans->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function toggleDetails(id) {
            const element = document.getElementById(id);
            if (element) {
                element.classList.toggle('hidden');
            }
        }
    </script>
</x-app-layout>