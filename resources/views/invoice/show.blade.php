<x-app-layout>
    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-semibold">Detail Invoice</h2>
                        <div class="flex space-x-2">
                            <a href="{{ route('invoice.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                                Kembali
                            </a>
                            <a href="{{ route('invoice.print', $invoice->id) }}" 
                               target="_blank"
                               class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                </svg>
                                Cetak
                            </a>
                        </div>
                    </div>

                    <!-- Invoice Content -->
                    <div class="border border-gray-200 rounded-lg">
                        <!-- Header -->
                        <div class="p-6 border-b border-gray-200">
                            <div class="flex justify-between items-start">
                                <!-- Company Info -->
                                <div>
                                    <h2 class="text-2xl font-bold text-gray-800">Dyacom</h2>
                                    <p class="mt-2 text-sm text-gray-600">
                                        Jl. Selamerta No.51<br>
                                        Denpasar, Bali<br>
                                        08123456789
                                    </p>
                                </div>

                                <!-- Invoice Info -->
                                <div class="text-right">
                                    <h1 class="text-xl font-bold text-gray-800">INVOICE</h1>
                                    <p class="mt-2 text-sm text-gray-600">
                                        No: INV-{{ str_pad($invoice->id, 6, '0', STR_PAD_LEFT) }}<br>
                                        Tanggal: {{ $invoice->created_at->format('d/m/Y H:i') }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Customer Info -->
                        <div class="p-6 border-b border-gray-200 bg-gray-50">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <h3 class="font-semibold text-gray-800">Pembeli:</h3>
                                    <p class="mt-1 text-sm text-gray-600">
                                        {{ $invoice->buyer_name ?? 'Tamu' }}<br>
                                        {{ $invoice->buyer_phone ?? '-' }}<br>
                                        {{ $invoice->buyer_email ?? '' }}
                                    </p>
                                </div>
                                <div class="text-right">
                                    <h3 class="font-semibold text-gray-800">Status Pembayaran:</h3>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Lunas
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Items Table -->
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Produk</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Harga Satuan</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Qty</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($invoice->details as $index => $detail)
                                <tr>
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $detail->product }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900 text-right">
                                        Rp {{ number_format($detail->harga, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 text-center">
                                        {{ $detail->quantity }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 text-right">
                                        Rp {{ number_format($detail->sub_total, 0, ',', '.') }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Total -->
                        <div class="p-6 border-t border-gray-200">
                            <div class="flex justify-end">
                                <div class="text-right space-y-2">
                                    <div class="flex justify-between w-64">
                                        <span class="text-sm text-gray-700">Subtotal:</span>
                                        <span class="text-sm text-gray-900">Rp {{ number_format($invoice->details->sum('sub_total'), 0, ',', '.') }}</span>
                                    </div>
                                    @if($invoice->diskon > 0)
                                    <div class="flex justify-between w-64">
                                        <span class="text-sm text-gray-700">Diskon:</span>
                                        <span class="text-sm text-gray-900">- Rp {{ number_format($invoice->diskon, 0, ',', '.') }}</span>
                                    </div>
                                    @endif
                                    <div class="flex justify-between w-64 border-t border-gray-200 pt-2 mt-2">
                                        <span class="text-base font-semibold text-gray-800">Total Bayar:</span>
                                        <span class="text-lg font-bold text-gray-900">
                                            Rp {{ number_format($invoice->total, 0, ',', '.') }}
                                        </span>
                                    </div>
                                    <div class="flex justify-between w-64">
                                        <span class="text-sm text-gray-700">Dibayar:</span>
                                        <span class="text-sm text-gray-900">Rp {{ number_format($invoice->bayar, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="flex justify-between w-64">
                                        <span class="text-sm font-semibold text-gray-800">Kembalian:</span>
                                        <span class="text-sm font-semibold text-gray-900">
                                            Rp {{ number_format($invoice->kembalian, 0, ',', '.') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="p-6 border-t border-gray-200 text-center text-sm text-gray-600">
                            <p>Terima kasih telah berbelanja di Dyacom</p>
                            <p class="mt-2 text-xs text-gray-500">
                                Invoice ini adalah bukti pembayaran yang sah
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
