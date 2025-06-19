<x-app-layout>
    <div class="max-w-4xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Profile Header -->
                <div class="bg-[#172A5A] p-6 text-white">
                    <div class="flex items-center space-x-6">
                        <div class="relative">
                            <label for="profile_photo" class="cursor-pointer">
                                @if(Auth::user()->profile_photo_path)
                                    <img id="preview" src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" 
                                         class="w-20 h-20 rounded-full object-cover border-2 border-white">
                                @else
                                    <div id="preview" class="w-20 h-20 rounded-full bg-blue-500 flex items-center justify-center text-white text-3xl font-bold border-2 border-white">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </div>
                                @endif
                            </label>
                            <input type="file" id="profile_photo" name="profile_photo" class="hidden" onchange="previewImage(this)">
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold">{{ Auth::user()->name }}</h2>
                            <p class="text-sm text-gray-300">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                </div>

                <!-- Form Body -->
                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name', Auth::user()->name) }}" 
                                   class="w-full px-4 py-2 bg-[#F3F3FD] border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email', Auth::user()->email) }}" 
                                   class="w-full px-4 py-2 bg-[#F3F3FD] border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 text-gray-500" readonly>
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                            <input type="text" id="phone" name="phone" value="{{ old('phone', Auth::user()->phone) }}" 
                                   class="w-full px-4 py-2 bg-[#F3F3FD] border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            @error('phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                            <input type="text" id="address" name="address" value="{{ old('address', Auth::user()->address) }}" 
                                   class="w-full px-4 py-2 bg-[#F3F3FD] border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                             @error('address')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end">
                        <button type="submit" class="px-8 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#172A5A] hover:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Edit
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@push('scripts')
<script>
    function previewImage(input) {
        const preview = document.getElementById('preview');
        const file = input.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            if (preview.tagName === 'IMG') {
                preview.src = e.target.result;
            } else {
                // If it was a div, replace it with an img element
                const img = document.createElement('img');
                img.id = 'preview';
                img.src = e.target.result;
                img.className = 'w-20 h-20 rounded-full object-cover border-2 border-white';
                preview.replaceWith(img);
            }
        }

        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>
@endpush
</x-app-layout>
