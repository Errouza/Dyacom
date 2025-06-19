<x-app-layout>
    @push('head')
        {{-- Load Alpine.js for modal interactivity --}}
        <script src="//unpkg.com/alpinejs" defer></script>
    @endpush

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                {{-- Initialize Alpine.js component for the search modal --}}
                <div class="p-6 bg-white border-b border-gray-200" x-data="searchModal()">
                    <div class="mb-6">
                        <h2 class="text-2xl font-semibold">Tambah Transaksi Baru</h2>
                    </div>

                    {{-- The main form --}}
                    <form id="transaction-form" action="{{ route('transaksi.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="items" id="items-input">

                        <div class="grid grid-cols-2 gap-x-8 gap-y-4">
                            <!-- Kolom Kiri: Item selection and details -->
                            <div class="space-y-4">
                                
                                <!-- Search Button to trigger modal -->
                                <div>
                                    <label for="product-display" class="block text-sm font-medium text-gray-700">Barang</label>
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                        <input type="text" id="product-display" readonly placeholder="Klik cari untuk memilih barang"
                                            class="flex-1 block w-full rounded-l-md bg-gray-100 border-gray-300 sm:text-sm">
                                        <button type="button" @click="open = true" class="relative -ml-px inline-flex items-center space-x-2 px-4 py-2 border border-gray-300 text-sm font-medium rounded-r-md text-gray-700 bg-gray-50 hover:bg-gray-100 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                            </svg>
                                            <span>Cari</span>
                                        </button>
                                    </div>
                                </div>
                                
                                {{-- Hidden input to store the selected item's ID --}}
                                <input type="hidden" id="id_barang">
                                <input type="hidden" id="product">

                                <div>
                                    <label for="harga" class="block text-sm font-medium text-gray-700">Harga (Rp)</label>
                                    <input type="number" id="harga" readonly
                                        class="mt-1 block w-full rounded-md bg-gray-100 border-gray-300 sm:text-sm">
                                </div>

                                <div>
                                    <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                                    <input type="number" id="quantity" value="1" min="1"
                                        class="mt-1 block w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                        onchange="hitungSubTotal()">
                                </div>

                                <div>
                                    <label for="sub_total" class="block text-sm font-medium text-gray-700">Sub Total (Rp)</label>
                                    <input type="number" id="sub_total" readonly
                                        class="mt-1 block w-full rounded-md bg-gray-100 border-gray-300 sm:text-sm">
                                </div>

                                <div>
                                    <button type="button" onclick="tambahItem()" 
                                        class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                        + Tambah
                                    </button>
                                </div>
                            </div>

                            <!-- Kolom Kanan: Totals and payment -->
                            <div class="space-y-4">
                                <div>
                                    <label for="total" class="block text-sm font-medium text-gray-700">Total (Rp)</label>
                                    <input type="number" name="total" id="total" readonly
                                        class="mt-1 block w-full rounded-md bg-gray-100 border-gray-300 sm:text-sm">
                                </div>

                                <div>
                                    <label for="bayar" class="block text-sm font-medium text-gray-700">Bayar (Rp)</label>
                                    <input type="number" name="bayar" id="bayar" value="0"
                                        class="mt-1 block w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                        onchange="hitungKembalian()">
                                </div>

                                <div>
                                    <label for="kembalian" class="block text-sm font-medium text-gray-700">Kembalian (Rp)</label>
                                    <input type="number" name="kembalian" id="kembalian" readonly
                                        class="mt-1 block w-full rounded-md bg-gray-100 border-gray-300 sm:text-sm">
                                </div>

                                <div>
                                    <label for="buyer_name" class="block text-sm font-medium text-gray-700">Nama Pembeli (Opsional)</label>
                                    <input type="text" name="buyer_name" id="buyer_name"
                                        class="mt-1 block w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                        placeholder="Masukkan nama pembeli">
                                </div>
                            </div>
                        </div>

                        {{-- Table to display items added to the transaction --}}
                        <div class="mt-8">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Barang</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sub Total</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="item-list" class="bg-white divide-y divide-gray-200">
                                    <!-- Items will be added here dynamically by JavaScript -->
                                </tbody>
                            </table>
                        </div>

                        {{-- Form action buttons --}}
                        <div class="mt-6 flex items-center justify-end space-x-3">
                            <a href="{{ route('transaksi.index') }}" 
                                class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2">
                                Batal
                            </a>
                            <button type="submit" 
                                class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                Simpan Transaksi
                            </button>
                        </div>
                    </form>

                    {{-- Search Modal --}}
                    <div x-show="open" @keydown.escape.window="open = false" 
                         class="fixed inset-0 z-50 flex items-center justify-center bg-black/20"
                         x-transition:enter="ease-out duration-300"
                         x-transition:enter-start="opacity-0"
                         x-transition:enter-end="opacity-100"
                         x-transition:leave="ease-in duration-200"
                         x-transition:leave-start="opacity-100"
                         x-transition:leave-end="opacity-0"
                         style="display: none;">
                        <div class="bg-white rounded-lg shadow-xl w-full max-w-lg mx-4" @click.away="open = false">
                            <div class="p-4">
                                <input type="text" x-model.debounce.300ms="searchQuery" placeholder="Ketik nama barang..." x-ref="searchInput"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div class="max-h-80 overflow-y-auto border-t border-gray-200">
                                <template x-if="isLoading">
                                    <p class="p-4 text-center text-gray-500">Mencari...</p>
                                </template>
                                <template x-if="!isLoading && results.length === 0">
                                    <p class="p-4 text-center text-gray-500" x-text="searchQuery ? 'Barang tidak ditemukan.' : 'Mulai ketik untuk mencari.'"></p>
                                </template>
                                <ul>
                                    <template x-for="item in results" :key="item.id">
                                        <li @click="selectItem(item)" class="px-4 py-3 border-b border-gray-200 hover:bg-gray-100 cursor-pointer">
                                            <h4 class="font-semibold text-gray-800" x-text="item.product"></h4>
                                            <p class="text-sm text-gray-600" x-text="`Stok: ${item.stok} | Harga: ${formatRupiah(item.harga)}`"></p>
                                        </li>
                                    </template>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        let items = [];

        function searchModal() {
            return {
                open: false,
                searchQuery: '',
                results: [],
                isLoading: false,
                selectItem(item) {
                    document.getElementById('id_barang').value = item.id;
                    document.getElementById('product').value = item.product;
                    document.getElementById('product-display').value = item.product;
                    document.getElementById('harga').value = item.harga;
                    document.getElementById('quantity').value = 1;
                    hitungSubTotal();
                    this.open = false;
                    this.searchQuery = '';
                    this.results = [];
                },
                init() {
                    this.$watch('open', (isOpen) => {
                        if (isOpen) {
                            this.$nextTick(() => this.$refs.searchInput.focus());
                        }
                    });

                    this.$watch('searchQuery', (query) => {
                        if (query.length < 2) {
                            this.results = [];
                            return;
                        }
                        this.isLoading = true;
                        fetch(`{{ route('api.barang-service.search') }}?q=${query}`)
                            .then(res => res.json())
                            .then(data => {
                                this.results = data;
                                this.isLoading = false;
                            })
                            .catch(() => {
                                this.isLoading = false;
                            });
                    });
                }
            }
        }

        function formatRupiah(number) {
            return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(number);
        }

        function hitungSubTotal() {
            const harga = document.getElementById('harga').value || 0;
            const quantity = document.getElementById('quantity').value || 0;
            const subTotal = harga * quantity;
            document.getElementById('sub_total').value = subTotal;
        }

        function hitungTotal() {
            const total = items.reduce((sum, item) => sum + item.sub_total, 0);
            document.getElementById('total').value = total;
            hitungKembalian();
        }

        function hitungKembalian() {
            const total = document.getElementById('total').value || 0;
            const bayar = document.getElementById('bayar').value || 0;
            const kembalian = bayar - total;
            document.getElementById('kembalian').value = kembalian;
        }

        function tambahItem() {
            const id_barang = document.getElementById('id_barang').value;
            const product = document.getElementById('product').value;
            const harga = document.getElementById('harga').value;
            const quantity = document.getElementById('quantity').value;
            const sub_total = document.getElementById('sub_total').value;

            if (!id_barang || !product || !harga || !quantity) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Pilih barang dan tentukan kuantitas terlebih dahulu!'
                });
                return;
            }

            const item = {
                id_barang,
                product,
                harga: parseFloat(harga),
                quantity: parseInt(quantity),
                sub_total: parseFloat(sub_total)
            };

            items.push(item);
            renderItems();
            hitungTotal();
            resetForm();
        }

        function hapusItem(index) {
            items.splice(index, 1);
            renderItems();
            hitungTotal();
        }

        function resetForm() {
            document.getElementById('id_barang').value = '';
            document.getElementById('product').value = '';
            document.getElementById('product-display').value = '';
            document.getElementById('harga').value = '';
            document.getElementById('quantity').value = '1';
            document.getElementById('sub_total').value = '';
        }

        function renderItems() {
            const tbody = document.getElementById('item-list');
            tbody.innerHTML = items.map((item, index) => `
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${item.id_barang}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${item.product}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${formatRupiah(item.harga)}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${item.quantity}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${formatRupiah(item.sub_total)}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <button type="button" onclick="hapusItem(${index})"
                            class="text-red-600 hover:text-red-900">Hapus</button>
                    </td>
                </tr>
            `).join('');
        }

        document.getElementById('transaction-form').addEventListener('submit', function(e) {
            if (items.length === 0) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Transaksi Kosong',
                    text: 'Harap tambahkan setidaknya satu barang sebelum menyimpan.'
                });
                return;
            }
            document.getElementById('items-input').value = JSON.stringify(items);
        });
    </script>
    @endpush
</x-app-layout>
