<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Dyacom</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-[#172A5A] min-h-screen flex items-center justify-center font-sans">
    <div class="absolute top-16 left-0 right-0 text-center">
        <span class="text-3xl font-bold text-white tracking-widest">DYACOM</span>
    </div>
    <div class="bg-white rounded-xl shadow-lg p-10 w-full max-w-[370px] text-center">
        <h2 class="text-xl font-semibold mb-6 text-[#222]">Create your account</h2>
        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf
            @if($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="text-left">
                <label class="block text-base text-[#222] mb-1" for="name">Nama Lengkap</label>
                <input class="w-full px-4 py-3 border border-gray-200 rounded-md text-base focus:border-blue-600 focus:outline-none mb-1 @error('name') border-red-500 @enderror" 
                       type="text" id="name" name="name" value="{{ old('name') }}" required autofocus>
            </div>
            <div class="text-left">
                <label class="block text-base text-[#222] mb-1" for="email">Email</label>
                <input class="w-full px-4 py-3 border border-gray-200 rounded-md text-base focus:border-blue-600 focus:outline-none mb-1 @error('email') border-red-500 @enderror" 
                       type="email" id="email" name="email" value="{{ old('email') }}" required>
            </div>
            <div class="text-left">
                <label class="block text-base text-[#222] mb-1" for="password">Password</label>
                <input class="w-full px-4 py-3 border border-gray-200 rounded-md text-base focus:border-blue-600 focus:outline-none mb-1 @error('password') border-red-500 @enderror" 
                       type="password" id="password" name="password" required>
            </div>
            <div class="text-left">
                <label class="block text-base text-[#222] mb-1" for="password_confirmation">Konfirmasi Password</label>
                <input class="w-full px-4 py-3 border border-gray-200 rounded-md text-base focus:border-blue-600 focus:outline-none mb-1" 
                       type="password" id="password_confirmation" name="password_confirmation" required>
            </div>
            <button class="w-full bg-blue-600 hover:bg-blue-800 text-white rounded-md py-3 text-base font-semibold transition-colors" type="submit">Sign Up</button>
        </form>
        <div class="mt-6 text-base text-[#222]">
            Already have an account? <a href="{{ route('login') }}" class="text-blue-600 font-semibold hover:underline">Login</a>
        </div>
    </div>
</body>
</html>
