<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-6">
                        <h2 class="text-2xl font-semibold">Tambah Transaksi Baru</h2>
                    </div>

                    <form action="{{ route('transaksi.store') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-2 gap-x-8 gap-y-4">
                            <!-- Kolom Kiri -->
                            <div class="space-y-4">
                                <div class="flex items-center gap-4">
                                    <div class="flex-1">
                                        <label for="id_barang" class="block text-sm font-medium text-gray-700">ID Barang</label>
                                        <div class="mt-1 flex rounded-md shadow-sm">
                                            <input type="text" name="id_barang" id="id_barang" value="{{ old('id_barang') }}"
                                                class="flex-1 block w-full rounded-l-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                            <button type="button" class="inline-flex items-center px-3 py-2 border border-l-0 border-gray-300 rounded-r-md bg-blue-600 text-white hover:bg-blue-700">
                                                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </div>
                                        @error('id_barang')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div>
                                    <label for="product" class="block text-sm font-medium text-gray-700">Product</label>
                                    <input type="text" name="product" id="product" value="{{ old('product') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                    @error('product')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="harga" class="block text-sm font-medium text-gray-700">Harga (Rp)</label>
                                    <input type="number" name="harga" id="harga" value="{{ old('harga') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                        onchange="hitungSubTotal()">
                                    @error('harga')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                                    <input type="number" name="quantity" id="quantity" value="{{ old('quantity', 1) }}" min="1"
                                        class="mt-1 block w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                        onchange="hitungSubTotal()">
                                    @error('quantity')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="sub_total" class="block text-sm font-medium text-gray-700">Sub Total (Rp)</label>
                                    <input type="number" name="sub_total" id="sub_total" readonly
                                        class="mt-1 block w-full rounded-md bg-gray-50 border-gray-300 focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                </div>

                                <div>
                                    <button type="button" onclick="tambahItem()" 
                                        class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                        + Tambah
                                    </button>
                                </div>
                            </div>

                            <!-- Kolom Kanan -->
                            <div class="space-y-4">
                                <div>
                                    <label for="total" class="block text-sm font-medium text-gray-700">Total (Rp)</label>
                                    <input type="number" name="total" id="total" readonly
                                        class="mt-1 block w-full rounded-md bg-gray-50 border-gray-300 focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                </div>

                                <div>
                                    <label for="bayar" class="block text-sm font-medium text-gray-700">Bayar (Rp)</label>
                                    <input type="number" name="bayar" id="bayar"
                                        class="mt-1 block w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                        onchange="hitungKembalian()">
                                </div>

                                <div>
                                    <label for="kembalian" class="block text-sm font-medium text-gray-700">Kembali (Rp)</label>
                                    <input type="number" name="kembalian" id="kembalian" readonly
                                        class="mt-1 block w-full rounded-md bg-gray-50 border-gray-300 focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                </div>
                            </div>
                        </div>

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
                                    <!-- Items will be added here dynamically -->
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-6 flex items-center justify-end space-x-3">
                            <a href="{{ route('transaksi.index') }}" 
                                class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Batal
                            </a>
                            <button type="submit"
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Simpan Transaksi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('head')
    <script>
        let items = [];
        
        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR'
            }).format(angka);
        }

        function hitungSubTotal() {
            const harga = document.getElementById('harga').value || 0;
            const quantity = document.getElementById('quantity').value || 0;
            const subTotal = harga * quantity;
            document.getElementById('sub_total').value = subTotal;
        }

        function hitungTotal() {
            const total = items.reduce((sum, item) => sum + (item.harga * item.quantity), 0);
            document.getElementById('total').value = total;
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
                    text: 'Semua field harus diisi!'
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
            document.getElementById('harga').value = '';
            document.getElementById('quantity').value = '1';
            document.getElementById('sub_total').value = '';
        }

        function renderItems() {
            const tbody = document.getElementById('item-list');
            tbody.innerHTML = items.map((item, index) => `
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">${item.id_barang}</td>
                    <td class="px-6 py-4 whitespace-nowrap">${item.product}</td>
                    <td class="px-6 py-4 whitespace-nowrap">${formatRupiah(item.harga)}</td>
                    <td class="px-6 py-4 whitespace-nowrap">${item.quantity}</td>
                    <td class="px-6 py-4 whitespace-nowrap">${formatRupiah(item.sub_total)}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <button type="button" onclick="hapusItem(${index})"
                            class="text-red-600 hover:text-red-900">Hapus</button>
                    </td>
                </tr>
            `).join('');
        }
    </script>
    @endpush
</x-app-layout>
