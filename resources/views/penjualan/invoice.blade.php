<x-app-layout>
    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-semibold">Invoice Penjualan</h2>
                        <a href="{{ route('penjualan.index') }}" class="text-blue-600 hover:text-blue-900">Kembali ke Daftar</a>
                    <!-- Print Button -->
                    <button onclick="window.print()" class="mb-6 inline-flex items-center px-4 py-2 bg-[#172A5A] text-white rounded-md hover:bg-[#0f1d3d] print:hidden">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                        </svg>
                        Print Invoice
                    </button>

                    <!-- Invoice Content -->
                    <div class="border border-gray-200 rounded-lg print:border-0 print:shadow-none">
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
                                        No: INV-{{ $penjualan->id_pesanan }}<br>
                                        Tanggal: {{ $penjualan->tanggal->format('d/m/Y') }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Customer Info -->
                        <div class="p-6 border-b border-gray-200 bg-gray-50">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <h3 class="font-semibold text-gray-800">Customer:</h3>
                                    <p class="mt-1 text-sm text-gray-600">
                                        {{ $penjualan->customer->name }}<br>
                                        {{ $penjualan->customer->phone ?? '-' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Items Table -->
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Product</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Harga</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Qty</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Total</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4 text-sm text-gray-900">1</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $penjualan->id_pesanan }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900 text-right">
                                        Rp {{ number_format($penjualan->price_total / $penjualan->quantity, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 text-right">{{ $penjualan->quantity }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900 text-right">
                                        Rp {{ number_format($penjualan->price_total, 0, ',', '.') }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Total -->
                        <div class="p-6 border-t border-gray-200">
                            <div class="flex justify-end">
                                <div class="text-right">
                                    <p class="text-sm text-gray-700">Total Bayar:</p>
                                    <p class="text-2xl font-bold text-gray-900">
                                        Rp {{ number_format($penjualan->price_total, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="p-6 border-t border-gray-200 text-center text-sm text-gray-600">
                            Terima kasih telah berbelanja di Dyacom
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('head')
    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            .print-section, .print-section * {
                visibility: visible;
            }
            .print-section {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }
            .print-hidden {
                display: none;
            }
        }
    </style>
    @endpush

    <script>
        // Auto print when using download/PDF generation
        if(window.location.href.includes('download-invoice')) {
            window.print();
        }
    </script>
</x-app-layout>