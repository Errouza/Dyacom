<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-semibold">Daftar Invoice</h2>
                        <div class="flex space-x-2">
                            <a href="{{ route('penjualan.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                                Kembali ke Penjualan
                            </a>
                        </div>
                    </div>
                    
                    <!-- Modal Backdrop -->
                    <div id="modalBackdrop" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50"></div>
                    
                    <!-- Modal Container -->
                    <div id="invoiceModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
                        <div class="relative bg-white rounded-lg shadow-xl w-full max-w-4xl max-h-[90vh] overflow-y-auto">
                            <!-- Modal Header -->
                            <div class="flex items-center justify-between p-4 border-b sticky top-0 bg-white z-10">
                                <h3 class="text-xl font-semibold">Detail Invoice</h3>
                                <div class="flex space-x-2">
                                    <button id="printInvoiceBtn" class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                        </svg>
                                        Cetak
                                    </button>
                                    <button id="closeModalBtn" class="ml-2 text-gray-500 hover:text-gray-700">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Modal Content -->
                            <div id="modalContent" class="p-6">
                                <!-- Content will be loaded here via AJAX -->
                                <div class="text-center py-8 text-gray-500">
                                    Memuat data invoice...
                                </div>
                            </div>
                            
                            <!-- Modal Footer -->
                            <div class="p-4 border-t flex justify-end sticky bottom-0 bg-white">
                                <button id="closeModalBtn2" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                                    Tutup
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Print Container (Hidden) -->
                    <div id="printContainer" class="hidden"></div>

                    <!-- Filter Tanggal -->
                    <form method="GET" action="{{ route('invoice.index') }}" class="mb-6">
                        <div class="flex flex-wrap items-end gap-4">
                            <div>
                                <label for="start_date" class="block text-sm font-medium text-gray-700">Dari Tanggal</label>
                                <input type="date" name="start_date" id="start_date" 
                                       value="{{ request('start_date') }}" 
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>
                            <div>
                                <label for="end_date" class="block text-sm font-medium text-gray-700">Sampai Tanggal</label>
                                <input type="date" name="end_date" id="end_date" 
                                       value="{{ request('end_date') }}" 
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>
                            <div class="flex space-x-2">
                                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                    Filter
                                </button>
                                <a href="{{ route('invoice.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">
                                    Reset
                                </a>
                            </div>
                        </div>
                    </form>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Transaksi</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pembeli</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($invoices as $invoice)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $loop->iteration }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $invoice->created_at->format('d/m/Y H:i') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ str_pad($invoice->id, 6, '0', STR_PAD_LEFT) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $invoice->buyer_name ?? 'Tamu' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-right">
                                            Rp {{ number_format($invoice->total, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">
                                            <div class="flex justify-center space-x-2">
                                                <button onclick="showInvoice({{ $invoice->id }})" class="text-blue-600 hover:text-blue-900">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </button>
                                                <button onclick="printInvoice({{ $invoice->id }})" class="text-green-600 hover:text-green-900">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                                            Tidak ada data invoice
                                        </td>
                                    </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $invoices->links() }}
                    </div>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@push('scripts')
<script>
    let currentInvoiceId = null;

    // Show invoice in modal
    function showInvoice(invoiceId) {
        currentInvoiceId = invoiceId;
        const modal = document.getElementById('invoiceModal');
        const modalBackdrop = document.getElementById('modalBackdrop');
        const modalContent = document.getElementById('modalContent');
        
        // Show loading state
        modalContent.innerHTML = `
            <div class="text-center py-8 text-gray-500">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-gray-900 mx-auto mb-4"></div>
                <p>Memuat data invoice...</p>
            </div>`;
        
        // Show modal
        modal.classList.remove('hidden');
        modalBackdrop.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        
        // Load invoice content via AJAX
        fetch(`/invoice/${invoiceId}/show-content`)
            .then(response => response.text())
            .then(html => {
                modalContent.innerHTML = html;
            })
            .catch(error => {
                console.error('Error:', error);
                modalContent.innerHTML = `
                    <div class="text-center py-8 text-red-500">
                        <p>Gagal memuat data invoice. Silakan coba lagi.</p>
                        <button onclick="showInvoice(${invoiceId})" class="mt-2 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Coba Lagi
                        </button>
                    </div>`;
            });
    }
    
    // Print invoice
    function printInvoice(invoiceId) {
        // Show loading state
        const printContainer = document.getElementById('printContainer');
        printContainer.innerHTML = `
            <div class="fixed inset-0 bg-white flex items-center justify-center">
                <div class="text-center">
                    <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-gray-900 mx-auto mb-4"></div>
                    <p>Mempersiapkan cetakan...</p>
                </div>
            </div>`;
        
        // Load print content via AJAX
        fetch(`/invoice/${invoiceId}/print-content`)
            .then(response => response.text())
            .then(html => {
                printContainer.innerHTML = html;
                
                // Wait for images to load before printing
                const images = printContainer.getElementsByTagName('img');
                let imagesToLoad = images.length;
                
                if (imagesToLoad === 0) {
                    window.print();
                    return;
                }
                
                const imageLoaded = () => {
                    imagesToLoad--;
                    if (imagesToLoad === 0) {
                        window.print();
                    }
                };
                
                for (let img of images) {
                    if (img.complete) {
                        imageLoaded();
                    } else {
                        img.onload = imageLoaded;
                        img.onerror = imageLoaded; // In case image fails to load
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Gagal memuat halaman cetak. Silakan coba lagi.');
                printContainer.innerHTML = '';
            });
    }
    
    // Close modal
    function closeModal() {
        document.getElementById('invoiceModal').classList.add('hidden');
        document.getElementById('modalBackdrop').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
    
    // Event listeners
    document.addEventListener('DOMContentLoaded', function() {
        // Close modal when clicking outside content
        document.getElementById('modalBackdrop').addEventListener('click', closeModal);
        
        // Close modal buttons
        document.getElementById('closeModalBtn').addEventListener('click', closeModal);
        document.getElementById('closeModalBtn2').addEventListener('click', closeModal);
        
        // Print button in modal
        document.getElementById('printInvoiceBtn').addEventListener('click', function() {
            if (currentInvoiceId) {
                printInvoice(currentInvoiceId);
            }
        });
        
        // Close print dialog after printing
        window.addEventListener('afterprint', function() {
            // Clear print container after a delay
            setTimeout(() => {
                document.getElementById('printContainer').innerHTML = '';
            }, 500);
        });
    });
</script>
@endpush

</x-app-layout>
