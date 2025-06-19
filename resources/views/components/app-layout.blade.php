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
    @if (session('success'))
    <script>
        Swal.fire({
            html: `
                <div class="pt-8 pb-4">
                    <h2 class="text-2xl font-bold text-gray-800">{{ session('success') }}</h2>
                </div>
                <div class="bg-[#172A5A] p-4 flex justify-center items-center rounded-b-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
            `,
            showConfirmButton: false,
            timer: 2500,
            customClass: {
                popup: 'p-0 rounded-lg shadow-lg'
            },
            width: '320px'
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
            <a href="{{ route('profile.edit') }}" class="block">
                <div class="flex items-center gap-3 p-4 border-t border-white/10 hover:bg-white/5 transition-colors">
                    @auth
                        @if (Auth::user()->profile_photo_path)
                            <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" alt="Profile" class="w-10 h-10 rounded-full object-cover">
                        @else
                            <div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-semibold">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                        @endif
                        <div class="flex-1">
                            <p class="text-sm font-medium text-white">{{ Auth::user()->name }}</p>
            
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white/60" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    @else
                        <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center text-white font-semibold">
                            <span class="text-2xl font-bold">G</span>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-white">Guest</p>
                        </div>
                    @endauth
                </div>
            </a>
            <nav class="flex-1 px-4 py-6">
                <div class="mb-4 text-xs font-bold text-white/60">SERVIS</div>
                <ul class="space-y-2 mb-6">
                    <li><a href="{{ route('transaksi.index') }}" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-white/10">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                        Transaksi Servis
                    </a></li>
                    <li><a href="{{ route('barang-service.index') }}" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-white/10">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
                        </svg>
                        Data Barang Servis
                    </a></li>
                    <li><a href="{{ route('barang-custom.index') }}" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-white/10">
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 92.04 122.88" class="w-5 h-5" fill="currentColor" xml:space="preserve">
                            <path style="fill-rule:evenodd;clip-rule:evenodd;" d="M21.74,33.56h48.65c0.24,0,0.44,0.2,0.44,0.44c0,3.15,0,1.05,0,4.19c0,0.24-0.2,0.44-0.44,0.44H21.74 c-0.29,0-0.53-0.24-0.53-0.53c0-3.09,0-0.93,0-4.02C21.21,33.8,21.45,33.56,21.74,33.56L21.74,33.56z M9.25,7.23h7.81V2.33 c0-1.28,1.28-2.33,2.85-2.33h0c1.57,0,2.85,1.05,2.85,2.33v4.89h12.4V2.33C35.16,1.05,36.44,0,38,0h0c1.57,0,2.85,1.05,2.85,2.33 v4.89h12.4V2.33C53.25,1.05,54.53,0,56.1,0h0c1.57,0,2.85,1.05,2.85,2.33v4.89h12.4V2.33c0-1.28,1.28-2.33,2.85-2.33h0 c1.57,0,2.85,1.05,2.85,2.33v4.89h5.74c5.09,0,9.25,4.16,9.25,9.25v97.15c0,5.09-4.16,9.25-9.25,9.25H9.25 c-5.09,0-9.25-4.16-9.25-9.25V16.48C0,11.39,4.16,7.23,9.25,7.23L9.25,7.23z M9.99,15.1h7.07v3.47c0,1.28,1.28,2.33,2.85,2.33h0 c1.57,0,2.85-1.05,2.85-2.33V15.1h12.4v3.47c0,1.28,1.28,2.33,2.85,2.33h0c1.57,0,2.85-1.05,2.85-2.33V15.1h12.4v3.47 c0,1.28,1.28,2.33,2.85,2.33h0c1.57,0,2.85-1.05,2.85-2.33V15.1h12.4v3.47c0,1.28,1.28,2.33,2.85,2.33h0 c1.57,0,2.85-1.05,2.85-2.33V15.1h5c1.43,0,2.61,1.18,2.61,2.61v94.68c0,1.42-1.18,2.61-2.61,2.61H9.99 c-1.42,0-2.61-1.17-2.61-2.61V17.71C7.38,16.28,8.56,15.1,9.99,15.1L9.99,15.1z M21.74,104.89h48.65c0.24,0,0.44-0.2,0.44-0.44 c0-3.15,0-1.05,0-4.19c0-0.24-0.2-0.44-0.44-0.44H21.74c-0.29,0-0.53,0.24-0.53,0.53c0,2.73,0,1.29,0,4.02 C21.21,104.65,21.45,104.89,21.74,104.89L21.74,104.89z M21.74,88.33h48.65c0.24,0,0.44-0.2,0.44-0.44c0-3.15,0-0.57,0-3.71 c0-0.24-0.2-0.44-0.44-0.44H21.74c-0.29,0-0.53,0.24-0.53,0.53c0,3.09,0,0.45,0,3.54C21.21,88.09,21.45,88.33,21.74,88.33 L21.74,88.33z M21.74,71.76h48.65c0.24,0,0.44-0.2,0.44-0.44c0-3.15,0-1.53,0-4.67c0-0.24-0.2-0.44-0.44-0.44H21.74 c-0.29,0-0.53,0.24-0.53,0.53c0,3.09,0,1.41,0,4.5C21.21,71.52,21.45,71.76,21.74,71.76L21.74,71.76z M21.74,55.2h48.65 c0.24,0,0.44-0.2,0.44-0.44c0-3.15,0-1.05,0-4.19c0-0.24-0.2-0.44-0.44-0.44H21.74c-0.29,0-0.53,0.24-0.53,0.53 c0,3.09,0,0.93,0,4.02C21.21,54.96,21.45,55.2,21.74,55.2L21.74,55.2z"/>
                        </svg>
                        Barang Custom
                    </a></li>
                </ul>
                <div class="mb-4 text-xs font-bold text-white/60">TRANSAKSI TOKO</div>
                <ul class="space-y-2">
                    <li><a href="{{ route('penjualan.index') }}" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-white/10">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        Penjualan
                    </a></li>
                    <li><a href="{{ route('invoice.index') }}" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-white/10">
                        <svg width="20" height="20" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13.5306 4.97L10.0306 1.47C9.96097 1.40026 9.87826 1.34494 9.78721 1.30719C9.69616 1.26944 9.59856 1.25 9.5 1.25H3.5C3.16848 1.25 2.85054 1.3817 2.61612 1.61612C2.3817 1.85054 2.25 2.16848 2.25 2.5V13.5C2.25 13.8315 2.3817 14.1495 2.61612 14.3839C2.85054 14.6183 3.16848 14.75 3.5 14.75H12.5C12.8315 14.75 13.1495 14.6183 13.3839 14.3839C13.6183 14.1495 13.75 13.8315 13.75 13.5V5.5C13.75 5.30124 13.6711 5.11062 13.5306 4.97ZM10 3.5625L11.4375 5H10V3.5625ZM3.75 13.25V2.75H8.5V5.75C8.5 5.94891 8.57902 6.13968 8.71967 6.28033C8.86032 6.42098 9.05109 6.5 9.25 6.5H12.25V13.25H3.75ZM10.75 8.25C10.75 8.44891 10.671 8.63968 10.5303 8.78033C10.3897 8.92098 10.1989 9 10 9H6C5.80109 9 5.61032 8.92098 5.46967 8.78033C5.32902 8.63968 5.25 8.44891 5.25 8.25C5.25 8.05109 5.32902 7.86032 5.46967 7.71967C5.61032 7.57902 5.80109 7.5 6 7.5H10C10.1989 7.5 10.3897 7.57902 10.5303 7.71967C10.671 7.86032 10.75 8.05109 10.75 8.25ZM10.75 10.75C10.75 10.9489 10.671 11.1397 10.5303 11.2803C10.3897 11.421 10.1989 11.5 10 11.5H6C5.80109 11.5 5.61032 11.421 5.46967 11.2803C5.32902 11.1397 5.25 10.9489 5.25 10.75C5.25 10.5511 5.32902 10.3603 5.46967 10.2197C5.61032 10.079 5.80109 10 6 10H10C10.1989 10 10.3897 10.079 10.5303 10.2197C10.671 10.3603 10.75 10.5511 10.75 10.75Z" fill="currentColor"/>
                        </svg>
                        Invoice
                    </a></li>
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

    @stack('scripts')
</body>
</html>
