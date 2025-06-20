<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#F0EBE3] overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-[#F0EBE3] border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-semibold">Data Barang Custom</h2>
                        <a href="{{ route('barang-custom.create') }}" 
                           class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition">
                            + Tambah Custom
                        </a>
                    </div>

                    <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative">
                        <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                            <thead>
                                <tr class="text-left">
                                    <th class="bg-gray-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">Kode</th>
                                    <th class="bg-gray-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">Pelanggan</th>
                                    <th class="bg-gray-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">Jenis</th>
                                    <th class="bg-gray-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">Status</th>
                                    <th class="bg-gray-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">Total Biaya</th>
                                    <th class="bg-gray-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">Estimasi</th>
                                    <th class="bg-gray-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse($barangCustoms as $custom)
                                    <tr>
                                        <td class="border-t border-gray-200 px-6 py-4">
                                            <div class="flex items-center">
                                                @if($custom->foto_hasil)
                                                    <div class="flex-shrink-0 h-10 w-10">
                                                        <img class="h-10 w-10 rounded-md object-cover" 
                                                             src="{{ Storage::url($custom->foto_hasil) }}" 
                                                             alt="{{ $custom->kode_custom }}">
                                                    </div>
                                                @endif
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">{{ $custom->kode_custom }}</div>
                                                    <div class="text-sm text-gray-500">{{ $custom->created_at->format('d/m/Y') }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="border-t border-gray-200 px-6 py-4">
                                            <div class="text-sm text-gray-900">{{ $custom->nama_pelanggan }}</div>
                                        </td>
                                        <td class="border-t border-gray-200 px-6 py-4">
                                            <div class="text-sm text-gray-900">{{ $custom->jenis_barang }}</div>
                                        </td>
                                        <td class="border-t border-gray-200 px-6 py-4">
                                            <select onchange="updateStatus('{{ $custom->id }}', this.value)" 
                                                    class="status-badge text-sm rounded-full px-3 py-1 {{ $custom->status_badge_class }} border-0 cursor-pointer">
                                                <option value="pending" {{ $custom->status === 'pending' ? 'selected' : '' }}>Menunggu</option>
                                                <option value="in_progress" {{ $custom->status === 'in_progress' ? 'selected' : '' }}>Dalam Proses</option>
                                                <option value="completed" {{ $custom->status === 'completed' ? 'selected' : '' }}>Selesai</option>
                                                <option value="cancelled" {{ $custom->status === 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                                            </select>
                                        </td>
                                        <td class="border-t border-gray-200 px-6 py-4">
                                            <div class="text-sm text-gray-900">Rp {{ number_format($custom->total_biaya, 0, ',', '.') }}</div>
                                        </td>
                                        <td class="border-t border-gray-200 px-6 py-4">
                                            <div class="text-sm text-gray-900">{{ $custom->estimasi_selesai->format('d/m/Y') }}</div>
                                        </td>
                                        <td class="border-t border-gray-200 px-6 py-4 text-right text-sm font-medium">
                                            <a href="{{ route('barang-custom.show', $custom) }}" 
                                               class="text-blue-600 hover:text-blue-900 mr-3" 
                                               title="Detail">
                                                <svg class="h-5 w-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                            </a>
                                            <a href="{{ route('barang-custom.edit', $custom) }}" 
                                               class="text-yellow-600 hover:text-yellow-900 mr-3"
                                               title="Edit">
                                                <svg class="h-5 w-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </a>
                                            <button onclick="confirmDelete('{{ $custom->id }}')" 
                                                    class="text-red-600 hover:text-red-900"
                                                    title="Hapus">
                                                <svg class="h-5 w-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                            <form id="delete-form-{{ $custom->id }}" 
                                                  action="{{ route('barang-custom.destroy', $custom) }}" 
                                                  method="POST" 
                                                  class="hidden">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="border-t border-gray-200 px-6 py-4 text-center text-gray-500">
                                            Belum ada data barang custom
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $barangCustoms->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('head')
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data barang custom akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }

        function updateStatus(id, status) {
            fetch(`/barang-custom/${id}/status`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ status: status })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: data.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Gagal mengubah status',
                });
            });
        }
    </script>
    @endpush
</x-app-layout>
