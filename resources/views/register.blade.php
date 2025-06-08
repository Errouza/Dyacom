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
        <form method="POST" action="#" class="space-y-5">
            @csrf
            <div class="text-left">
                <label class="block text-base text-[#222] mb-1" for="name">Name</label>
                <input class="w-full px-4 py-3 border border-gray-200 rounded-md text-base focus:border-blue-600 focus:outline-none mb-1" type="text" id="name" name="name" required autofocus>
            </div>
            <div class="text-left">
                <label class="block text-base text-[#222] mb-1" for="email">Email</label>
                <input class="w-full px-4 py-3 border border-gray-200 rounded-md text-base focus:border-blue-600 focus:outline-none mb-1" type="email" id="email" name="email" required>
            </div>
            <div class="text-left">
                <label class="block text-base text-[#222] mb-1" for="password">Password</label>
                <input class="w-full px-4 py-3 border border-gray-200 rounded-md text-base focus:border-blue-600 focus:outline-none mb-1" type="password" id="password" name="password" required>
            </div>
            <button class="w-full bg-blue-600 hover:bg-blue-800 text-white rounded-md py-3 text-base font-semibold transition-colors" type="submit">Sign Up</button>
        </form>
        <div class="mt-6 text-base text-[#222]">
            Already have an account? <a href="{{ route('login') }}" class="text-blue-600 font-semibold hover:underline">Login</a>
        </div>
    </div>
</body>
</html>
