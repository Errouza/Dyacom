<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-semibold">Data Barang Service</h2>
                        <a href="{{ route('barang-service.create') }}" 
                           class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                            + Tambah Data
                        </a>
                    </div>

                    <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative">
                        <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                            <thead>
                                <tr class="text-left">
                                    <th class="bg-gray-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">
                                        ID Barang
                                    </th>
                                    <th class="bg-gray-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">
                                        Product
                                    </th>
                                    <th class="bg-gray-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">
                                        Jenis Product
                                    </th>
                                    <th class="bg-gray-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">
                                        Stok
                                    </th>
                                    <th class="bg-gray-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">
                                        Harga
                                    </th>
                                    <th class="bg-gray-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($barangServices as $barang)
                                    <tr>
                                        <td class="border-t border-gray-200 px-6 py-4">
                                            <div class="flex items-center">
                                                @if($barang->image)
                                                    <div class="flex-shrink-0 h-10 w-10">
                                                        <img class="h-10 w-10 rounded-full object-cover" 
                                                             src="{{ Storage::url($barang->image) }}" 
                                                             alt="{{ $barang->product }}">
                                                    </div>
                                                @endif
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $barang->id_barang }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="border-t border-gray-200 px-6 py-4">
                                            <div class="text-sm text-gray-900">{{ $barang->product }}</div>
                                        </td>
                                        <td class="border-t border-gray-200 px-6 py-4">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                {{ $barang->jenis_product }}
                                            </span>
                                        </td>
                                        <td class="border-t border-gray-200 px-6 py-4">
                                            <div class="text-sm text-gray-900">{{ $barang->stok }}</div>
                                        </td>
                                        <td class="border-t border-gray-200 px-6 py-4">
                                            <div class="text-sm text-gray-900">Rp {{ number_format($barang->harga, 0, ',', '.') }}</div>
                                        </td>
                                        <td class="border-t border-gray-200 px-6 py-4 text-right text-sm font-medium">
                                            <a href="{{ route('barang-service.edit', $barang) }}" 
                                               class="text-blue-600 hover:text-blue-900 mr-3">
                                                <svg class="h-5 w-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </a>
                                            <button onclick="confirmDelete('{{ $barang->id }}')" class="text-red-600 hover:text-red-900">
                                                <svg class="h-5 w-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                            <form id="delete-form-{{ $barang->id }}" 
                                                  action="{{ route('barang-service.destroy', $barang) }}" 
                                                  method="POST" 
                                                  class="hidden">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $barangServices->links() }}
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
                text: "Data barang akan dihapus permanen!",
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
    </script>
    @endpush
</x-app-layout>
