<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-6">
                        <h2 class="text-2xl font-semibold">Tambah Barang Custom</h2>
                    </div>

                    <form action="{{ route('barang-custom.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="grid grid-cols-2 gap-6">
                            <!-- Kolom Kiri -->
                            <div class="space-y-6">
                                <div>
                                    <label for="nama_pelanggan" class="block text-sm font-medium text-gray-700">Nama Pelanggan</label>
                                    <input type="text" name="nama_pelanggan" id="nama_pelanggan" value="{{ old('nama_pelanggan') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                        required>
                                    @error('nama_pelanggan')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="jenis_barang" class="block text-sm font-medium text-gray-700">Jenis Barang</label>
                                    <input type="text" name="jenis_barang" id="jenis_barang" value="{{ old('jenis_barang') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                        required>
                                    @error('jenis_barang')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="spesifikasi" class="block text-sm font-medium text-gray-700">Spesifikasi</label>
                                    <textarea name="spesifikasi" id="spesifikasi" rows="4"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                        required>{{ old('spesifikasi') }}</textarea>
                                    @error('spesifikasi')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="catatan" class="block text-sm font-medium text-gray-700">Catatan Tambahan</label>
                                    <textarea name="catatan" id="catatan" rows="3"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">{{ old('catatan') }}</textarea>
                                    @error('catatan')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Kolom Kanan -->
                            <div class="space-y-6">
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="biaya_design" class="block text-sm font-medium text-gray-700">Biaya Design</label>
                                        <div class="mt-1 relative rounded-md shadow-sm">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <span class="text-gray-500 sm:text-sm">Rp</span>
                                            </div>
                                            <input type="number" name="biaya_design" id="biaya_design" 
                                                value="{{ old('biaya_design', 0) }}" min="0"
                                                class="mt-1 block w-full pl-12 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                                onchange="hitungTotal()"
                                                required>
                                        </div>
                                        @error('biaya_design')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="biaya_produksi" class="block text-sm font-medium text-gray-700">Biaya Produksi</label>
                                        <div class="mt-1 relative rounded-md shadow-sm">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <span class="text-gray-500 sm:text-sm">Rp</span>
                                            </div>
                                            <input type="number" name="biaya_produksi" id="biaya_produksi" 
                                                value="{{ old('biaya_produksi', 0) }}" min="0"
                                                class="mt-1 block w-full pl-12 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                                onchange="hitungTotal()"
                                                required>
                                        </div>
                                        @error('biaya_produksi')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div>
                                    <label for="total_biaya" class="block text-sm font-medium text-gray-700">Total Biaya</label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500 sm:text-sm">Rp</span>
                                        </div>
                                        <input type="number" name="total_biaya" id="total_biaya" readonly
                                            class="mt-1 block w-full pl-12 rounded-md bg-gray-50 border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="tanggal_order" class="block text-sm font-medium text-gray-700">Tanggal Order</label>
                                        <input type="date" name="tanggal_order" id="tanggal_order" 
                                            value="{{ old('tanggal_order', date('Y-m-d')) }}"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                            required>
                                        @error('tanggal_order')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="estimasi_selesai" class="block text-sm font-medium text-gray-700">Estimasi Selesai</label>
                                        <input type="date" name="estimasi_selesai" id="estimasi_selesai" 
                                            value="{{ old('estimasi_selesai') }}"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                            required>
                                        @error('estimasi_selesai')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                    <select name="status" id="status"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                        <option value="pending" {{ old('status') === 'pending' ? 'selected' : '' }}>Menunggu</option>
                                        <option value="in_progress" {{ old('status') === 'in_progress' ? 'selected' : '' }}>Dalam Proses</option>
                                        <option value="completed" {{ old('status') === 'completed' ? 'selected' : '' }}>Selesai</option>
                                        <option value="cancelled" {{ old('status') === 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                                    </select>
                                    @error('status')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="design_file" class="block text-sm font-medium text-gray-700">File Design</label>
                                    <input type="file" name="design_file" id="design_file"
                                        class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                    <p class="mt-1 text-sm text-gray-500">Upload file design (PDF, DOC, atau gambar)</p>
                                    @error('design_file')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="foto_hasil" class="block text-sm font-medium text-gray-700">Foto Hasil</label>
                                    <input type="file" name="foto_hasil" id="foto_hasil" accept="image/*"
                                        class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                    <p class="mt-1 text-sm text-gray-500">Upload foto hasil custom (Optional)</p>
                                    @error('foto_hasil')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 flex items-center justify-end space-x-3">
                            <a href="{{ route('barang-custom.index') }}" 
                                class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Batal
                            </a>
                            <button type="submit"
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('head')
    <script>
        function hitungTotal() {
            const biayaDesign = parseFloat(document.getElementById('biaya_design').value) || 0;
            const biayaProduksi = parseFloat(document.getElementById('biaya_produksi').value) || 0;
            const total = biayaDesign + biayaProduksi;
            document.getElementById('total_biaya').value = total;
        }

        // Set minimum date for estimasi_selesai based on tanggal_order
        document.getElementById('tanggal_order').addEventListener('change', function() {
            document.getElementById('estimasi_selesai').min = this.value;
        });

        // Preview foto hasil before upload
        document.getElementById('foto_hasil').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.createElement('img');
                    preview.src = e.target.result;
                    preview.className = 'mt-2 rounded-lg w-full max-h-48 object-cover';
                    
                    const container = document.getElementById('foto_hasil').parentElement;
                    const existingPreview = container.querySelector('img');
                    if (existingPreview) {
                        existingPreview.remove();
                    }
                    container.appendChild(preview);
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
    @endpush
</x-app-layout>
