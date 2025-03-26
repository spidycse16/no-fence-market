<!-- resources/views/layouts/customer.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>No Fence Market - @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
    <!-- Header -->
    <header class="bg-blue-600 text-white p-4 sticky top-0 z-10 shadow-md">
        <div class="container mx-auto flex flex-col md:flex-row justify-between items-center">
            <!-- Logo -->
            <a href="/user/dashboard" class="flex items-center space-x-2 mb-4 md:mb-0">
                <img src="{{ asset('/storage/images/logo.png') }}" alt="No Fence Market Logo" class="h-10 w-10">
                <span class="text-2xl font-bold">No Fence Market</span>
            </a>

            <!-- Search Bar -->
            <form action="{{ route('customer.search') }}" method="GET" class="flex-1 mx-0 md:mx-6 mb-4 md:mb-0 w-full md:w-auto relative">
                <div class="flex">
                    <input 
                        type="text" 
                        name="search" 
                        id="search-input" 
                        placeholder="Search for products..." 
                        class="w-full p-2 rounded-l border border-gray-300 text-black focus:outline-none focus:border-blue-500"
                        autocomplete="off"
                    >
                    <button type="submit" class="bg-blue-500 text-white p-2 rounded-r hover:bg-blue-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </div>
                <!-- Autocomplete Suggestions -->
                <div id="suggestions" class="absolute w-full bg-white text-black rounded shadow-lg mt-1 hidden"></div>
            </form>

            <!-- Navigation -->
            <nav class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-6">
                <!-- Categories Dropdown -->
                <div class="relative group">
                    <button class="hover:text-gray-200 flex items-center">
                        Categories
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="absolute hidden group-hover:block mt-2 bg-white text-black rounded shadow-lg w-48">
                        @foreach(\App\Models\Catagory::all() as $catagory)
                            <a 
                                href="/user/products?catagory={{ $catagory->id }}" 
                                class="block px-4 py-2 hover:bg-gray-100"
                            >
                                {{ $catagory->catagory_name }}
                            </a>
                        @endforeach
                    </div>
                </div>
                <a href="{{ route('customer.products') }}" class="hover:text-gray-200">Products</a>
                <a href="{{ route('customer.cart') }}" class="hover:text-gray-200">Cart ({{ session('cart', []) ? count(session('cart')) : 0 }})</a>
                @auth
                    <a href="/profile" class="hover:text-gray-200">{{ auth()->user()->name }}</a>
                    <form action="/logout" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="hover:text-gray-200">Logout</button>
                    </form>
                @else
                    <a href="/login" class="hover:text-gray-200">Login</a>
                    <a href="/register" class="hover:text-gray-200">Register</a>
                @endauth
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white p-6">
        <div class="container mx-auto text-center">
            <p>© {{ date('Y') }} No Fence Market. All rights reserved.</p>
            <div class="flex justify-center space-x-6 mt-4">
                <a href="/about" class="hover:text-gray-300">About</a>
                <a href="/contact" class="hover:text-gray-300">Contact</a>
                <a href="/terms" class="hover:text-gray-300">Terms</a>
            </div>
        </div>
    </footer>

    <!-- Autocomplete Script -->
    <script>
        const searchInput = document.getElementById('search-input');
        const suggestionsDiv = document.getElementById('suggestions');

        searchInput.addEventListener('input', async function () {
            const query = this.value.trim();
            if (query.length < 2) {
                suggestionsDiv.classList.add('hidden');
                return;
            }

            const response = await fetch(`{{ route('customer.search.autocomplete') }}?query=${encodeURIComponent(query)}`);
            const suggestions = await response.json();

            if (suggestions.length === 0) {
                suggestionsDiv.classList.add('hidden');
                return;
            }

            suggestionsDiv.innerHTML = suggestions.map(s => `<div class="px-4 py-2 hover:bg-gray-100 cursor-pointer">${s}</div>`).join('');
            suggestionsDiv.classList.remove('hidden');

            suggestionsDiv.querySelectorAll('div').forEach(item => {
                item.addEventListener('click', function () {
                    searchInput.value = this.textContent;
                    suggestionsDiv.classList.add('hidden');
                    searchInput.closest('form').submit();
                });
            });
        });

        document.addEventListener('click', function (e) {
            if (!searchInput.contains(e.target) && !suggestionsDiv.contains(e.target)) {
                suggestionsDiv.classList.add('hidden');
            }
        });
    </script>
</body>
</html>