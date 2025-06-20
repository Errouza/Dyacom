<div class="space-y-6">
    <!-- Invoice Header -->
    <div class="flex justify-between items-start">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Dyacom</h2>
            <p class="mt-1 text-sm text-gray-600">
                Jl. Selamerta No.51<br>
                Denpasar, Bali<br>
                08123456789
            </p>
        </div>
        <div class="text-right">
            <h1 class="text-xl font-bold text-gray-800">INVOICE</h1>
            <p class="mt-1 text-sm text-gray-600">
                No: INV-{{ str_pad($invoice->id, 6, '0', STR_PAD_LEFT) }}<br>
                Tanggal: {{ $invoice->created_at->format('d/m/Y H:i') }}
            </p>
        </div>
    </div>

    <!-- Customer Info -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4 bg-gray-50 rounded-lg">
        <div>
            <h3 class="font-semibold text-gray-800">Pembeli:</h3>
            <p class="mt-1 text-sm text-gray-600">
                {{ $invoice->buyer_name ?? 'Tamu' }}<br>
                {{ $invoice->buyer_phone ?? '-' }}
            </p>
        </div>
        <div class="md:text-right">
            <h3 class="font-semibold text-gray-800">Status Pembayaran:</h3>
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                Lunas
            </span>
        </div>
    </div>

    <!-- Items Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk</th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Qty</th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Subtotal</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($invoice->details as $detail)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $detail->product }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-right">
                        Rp {{ number_format($detail->harga, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                        {{ $detail->quantity }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-right">
                        Rp {{ number_format($detail->sub_total, 0, ',', '.') }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Summary -->
    <div class="bg-gray-50 p-4 rounded-lg">
        <div class="flex justify-end">
            <div class="w-full max-w-xs space-y-2">
                <div class="flex justify-between">
                    <span class="text-sm text-gray-600">Subtotal:</span>
                    <span class="text-sm font-medium">Rp {{ number_format($invoice->details->sum('sub_total'), 0, ',', '.') }}</span>
                </div>
                @if($invoice->diskon > 0)
                <div class="flex justify-between">
                    <span class="text-sm text-gray-600">Diskon:</span>
                    <span class="text-sm font-medium">- Rp {{ number_format($invoice->diskon, 0, ',', '.') }}</span>
                </div>
                @endif
                <div class="flex justify-between pt-2 border-t border-gray-200">
                    <span class="text-base font-semibold">Total Bayar:</span>
                    <span class="text-lg font-bold">Rp {{ number_format($invoice->total, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-sm text-gray-600">Dibayar:</span>
                    <span class="text-sm font-medium">Rp {{ number_format($invoice->bayar, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-sm font-semibold">Kembalian:</span>
                    <span class="text-sm font-semibold">Rp {{ number_format($invoice->kembalian, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="text-center text-sm text-gray-500 pt-4 border-t border-gray-200">
        <p>Terima kasih telah berbelanja di Dyacom</p>
        <p class="text-xs mt-1">* Barang yang sudah dibeli tidak dapat ditukar/dikembalikan *</p>
    </div>
</div>
