<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Invoice #{{ str_pad($invoice->id, 6, '0', STR_PAD_LEFT) }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            @page {
                size: 80mm 297mm;
                margin: 0;
                padding: 10px;
            }
            body {
                width: 100% !important;
                margin: 0 !important;
                padding: 10px !important;
                font-size: 12px !important;
                line-height: 1.2 !important;
            }
            .no-print {
                display: none !important;
            }
            .print-only {
                display: block !important;
            }
            .break-after {
                page-break-after: always;
            }
        }
        .print-only {
            display: none;
        }
    </style>
</head>
<body class="font-sans bg-white">
    <div class="max-w-md mx-auto p-4">
        <!-- Header -->
        <div class="text-center mb-4">
            <h1 class="text-xl font-bold">DYACOM</h1>
            <p class="text-xs">Jl. Selamerta No.51, Denpasar, Bali</p>
            <p class="text-xs">Telp: 08123456789</p>
            <div class="border-t border-dashed border-gray-400 my-2"></div>
        </div>

        <!-- Invoice Info -->
        <div class="mb-4">
            <div class="flex justify-between items-start mb-2">
                <div>
                    <p class="font-semibold">INVOICE</p>
                    <p>#{{ str_pad($invoice->id, 6, '0', STR_PAD_LEFT) }}</p>
                </div>
                <div class="text-right">
                    <p>{{ $invoice->created_at->format('d/m/Y H:i') }}</p>
                    <p class="text-xs">Kasir: {{ $invoice->user->name ?? 'Admin' }}</p>
                </div>
            </div>
            <div class="border-t border-dashed border-gray-400 my-2"></div>
        </div>

        <!-- Customer Info -->
        <div class="mb-4">
            <div class="grid grid-cols-2 gap-2">
                <div>
                    <p class="font-semibold">Pembeli:</p>
                    <p>{{ $invoice->buyer_name ?? 'Tamu' }}</p>
                    @if($invoice->buyer_phone)
                        <p>{{ $invoice->buyer_phone }}</p>
                    @endif
                </div>
                <div class="text-right">
                    <p class="font-semibold">Status:</p>
                    <span class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded">LUNAS</span>
                </div>
            </div>
            <div class="border-t border-dashed border-gray-400 my-2"></div>
        </div>

        <!-- Items -->
        <div class="mb-4">
            <div class="grid grid-cols-12 gap-1 text-xs font-semibold mb-1">
                <div class="col-span-1">No</div>
                <div class="col-span-5">Barang</div>
                <div class="col-span-2 text-right">Harga</div>
                <div class="col-span-1 text-center">Qty</div>
                <div class="col-span-3 text-right">Subtotal</div>
            </div>
            
            @foreach($invoice->details as $index => $item)
            <div class="grid grid-cols-12 gap-1 text-xs py-1 border-b border-gray-100">
                <div class="col-span-1">{{ $loop->iteration }}</div>
                <div class="col-span-5">{{ $item->product }}</div>
                <div class="col-span-2 text-right">{{ number_format($item->harga, 0, ',', '.') }}</div>
                <div class="col-span-1 text-center">{{ $item->quantity }}</div>
                <div class="col-span-3 text-right">{{ number_format($item->sub_total, 0, ',', '.') }}</div>
            </div>
            @endforeach
            
            <div class="border-t border-dashed border-gray-400 my-2"></div>
        </div>

        <!-- Summary -->
        <div class="mb-4">
            <div class="flex justify-between text-sm mb-1">
                <span>Subtotal:</span>
                <span>Rp {{ number_format($invoice->details->sum('sub_total'), 0, ',', '.') }}</span>
            </div>
            @if($invoice->diskon > 0)
            <div class="flex justify-between text-sm mb-1">
                <span>Diskon:</span>
                <span>- Rp {{ number_format($invoice->diskon, 0, ',', '.') }}</span>
            </div>
            @endif
            <div class="flex justify-between text-sm font-bold mt-2 pt-2 border-t border-gray-200">
                <span>TOTAL:</span>
                <span>Rp {{ number_format($invoice->total, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between text-xs mt-1">
                <span>Dibayar:</span>
                <span>Rp {{ number_format($invoice->bayar, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between text-xs font-semibold mt-1">
                <span>Kembalian:</span>
                <span>Rp {{ number_format($invoice->kembalian, 0, ',', '.') }}</span>
            </div>
            <div class="border-t border-dashed border-gray-400 my-2"></div>
        </div>

        <!-- Footer -->
        <div class="text-center text-xs">
            <p>Terima kasih telah berbelanja di Dyacom</p>
            <p class="mt-1">* Barang yang sudah dibeli tidak dapat ditukar/dikembalikan *</p>
            <p class="mt-4 print-only">Dicetak pada: {{ now()->format('d/m/Y H:i:s') }}</p>
        </div>
    </div>

    <!-- Print Controls -->
    <div class="no-print fixed bottom-0 left-0 right-0 bg-white p-4 border-t border-gray-200 shadow-lg">
        <div class="max-w-md mx-auto flex justify-center space-x-4">
            <button onclick="window.print()" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Cetak Invoice
            </button>
            <a href="{{ route('invoice.show', $invoice->id) }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">
                Kembali
            </a>
        </div>
    </div>

    <script>
        // Auto print when page loads
        window.onload = function() {
            // Wait a moment to ensure all content is loaded
            setTimeout(function() {
                window.print();
                
                // Optional: Close the window after printing
                // window.onafterprint = function() {
                //     window.close();
                // };
            }, 500);
        };
    </script>
</body>
</html>
