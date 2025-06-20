{{-- resources/views/welcome.blade.php --}}
<x-app-layout>
    @section('head')
        <title>Dashboard - Dyacom</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <div class="flex min-h-screen">
        <!-- Main Content -->
        <main class="flex-1 bg-white min-h-screen">
            <header class="flex items-center justify-between px-8 py-4 border-b">
                <h1 class="text-lg font-bold">Dashboard</h1>
                <form id="logout-form" method="POST" action="{{ route('logout') }}" class="hidden">
                    @csrf
                </form>
                <button onclick="confirmLogout()" class="px-5 py-2 bg-[#172A5A] text-white rounded-lg font-semibold hover:bg-blue-900 transition">
                    Log Out
                </button>
                
                @push('scripts')
                <script>
                    function confirmLogout() {
                        Swal.fire({
                            title: 'Konfirmasi Logout',
                            text: 'Apakah Anda yakin ingin keluar?',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonColor: '#172A5A',
                            cancelButtonColor: '#6c757d',
                            confirmButtonText: 'Ya, Logout',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                document.getElementById('logout-form').submit();
                            }
                        });
                    }
                </script>
                @endpush
            </header>
            <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-cyan-400 rounded-lg p-6 flex flex-col justify-center items-start min-h-[120px]">
                    <div class="text-3xl font-bold text-white">Rp {{ number_format($totalPenjualanHariIni, 0, ',', '.') }}</div>
                    <div class="text-white text-lg">Penjualan Hari Ini</div>
                </div>
                <div class="bg-green-500 rounded-lg p-6 flex flex-col justify-center items-start min-h-[120px]">
                    <div class="text-3xl font-bold text-white">{{ number_format($totalBarangTerjual, 0, ',', '.') }}</div>
                    <div class="text-white text-lg">Total Barang Terjual</div>
                </div>
            </div>
            <div class="px-8 pb-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                <div class="bg-cyan-400 rounded-lg p-6 flex flex-col justify-center items-center">
                    <div class="text-2xl font-bold text-white">{{ number_format($barangCustomMasukHariIni, 0, ',', '.') }}</div>
                    <div class="text-white text-base text-center">Barang Custom Masuk Hari Ini</div>
                </div>
                <div class="bg-yellow-400 rounded-lg p-6 flex flex-col justify-center items-center">
                    <div class="text-2xl font-bold text-white">{{ number_format($prosesPengerjaan, 0, ',', '.') }}</div>
                    <div class="text-white text-base text-center">Proses Pengerjaan</div>
                </div>
                <div class="bg-red-500 rounded-lg p-6 flex flex-col justify-center items-center">
                    <div class="text-2xl font-bold text-white">{{ number_format($pengerjaanSelesai, 0, ',', '.') }}</div>
                    <div class="text-white text-base text-center">Pengerjaan Selesai</div>
                </div>
                <div class="bg-green-500 rounded-lg p-6 flex flex-col justify-center items-center">
                    <div class="text-2xl font-bold text-white">{{ number_format($barangDiambil, 0, ',', '.') }}</div>
                    <div class="text-white text-base text-center">Barang Telah diambil</div>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>
