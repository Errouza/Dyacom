<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('head')
</head>
<body class="font-sans antialiased bg-gray-100 min-h-screen">
    <!-- Session Status -->
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 3000
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: "{{ session('error') }}",
                showConfirmButton: true
            });
        </script>
    @endif

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-[#172A5A] text-white flex flex-col">
            <a href="/" class="flex items-center h-16 px-6 font-bold text-2xl tracking-widest border-b border-white/20 hover:text-blue-300 transition-colors">
                DYACOM
            </a>
            <div class="flex flex-col items-center py-6 border-b border-white/10">
                @if(isset($userImg) && $userImg)
                    <img src="{{ asset('storage/' . $userImg) }}" alt="User Image" class="w-16 h-16 rounded-full object-cover mb-2 border-2 border-white shadow" />
                @else
                    <div class="w-16 h-16 rounded-full bg-white/20 flex items-center justify-center mb-2">
                        <span class="text-2xl font-bold">A</span>
                    </div>
                @endif
                <div class="font-semibold">Aleeya Karina</div>
            </div>
            <nav class="flex-1 px-4 py-6">
                <div class="mb-4 text-xs font-bold text-white/60">SERVIS</div>
                <ul class="space-y-2 mb-6">
                    <li><a href="{{ route('transaksi.index') }}" class="flex items-center gap-2 px-3 py-2 rounded hover:bg-white/10"><span>🛠️</span>Transaksi Servis</a></li>
                    <li><a href="{{ route('barang-service.index') }}" class="flex items-center gap-2 px-3 py-2 rounded hover:bg-white/10"><span>📦</span>Data Barang Servis</a></li>
                    <li><a href="{{ route('barang-custom.index') }}" class="flex items-center gap-2 px-3 py-2 rounded hover:bg-white/10"><span>🎨</span>Barang Custom</a></li>
                </ul>
                <div class="mb-4 text-xs font-bold text-white/60">TRANSAKSI TOKO</div>
                <ul class="space-y-2">
                    <li><a href="{{ route('penjualan.index') }}" class="flex items-center gap-2 px-3 py-2 rounded hover:bg-white/10"><span>💰</span>Penjualan</a></li>
                    <li><a href="{{ route('invoice.index') }}" class="flex items-center gap-2 px-3 py-2 rounded hover:bg-white/10"><span>🧾</span>Invoice</a></li>
                </ul>
            </nav>
        </aside>
        <!-- Main Content -->
        <main class="flex-1 p-6 bg-gray-100">
            <div class="max-w-7xl mx-auto">
                <h1 class="text-2xl font-semibold mb-6">DYACOM</h1>
                {{ $slot }}
            </div>
        </main>
    </div>
</body>
</html>
