@extends('layouts.customer')

@section('title', 'Welcome to No Fence Market')

@section('content')
<div class="container mx-auto px-4 py-8">
    {{-- Hero Section --}}
    <div class="text-center bg-gradient-to-r from-blue-500 to-purple-600 text-white py-16 rounded-lg shadow-lg mb-12">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Welcome to No Fence Market</h1>
        <p class="text-xl text-white/90 max-w-2xl mx-auto">
            Discover an incredible selection of products from multiple vendors. 
            Quality, variety, and convenience at your fingertips.
        </p>
    </div>

    {{-- Main Content Grid --}}
    <div class="grid md:grid-cols-3 gap-8">
        {{-- Featured Products Section --}}
        <div class="md:col-span-2 bg-white rounded-xl shadow-md p-6 border border-gray-100">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">
                <svg class="inline-block w-8 h-8 mr-3 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h18M9 3v18M15 3v18"></path>
                </svg>
                Featured Products
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-2">
                @foreach(\App\Models\Product::inRandomOrder()->limit(10)->get() as $product)
                    <a href="{{ route('customer.product.show', $product->id) }}" class="block bg-gray-50 p-2 rounded-md hover:shadow-md transition duration-300">
                        @if($product->images->isNotEmpty())
                            <?php $primaryImage = $product->images->where('its_primary', 1)->first() ?? $product->images->first(); ?>
                            <img 
                                src="{{ asset('storage/' . $primaryImage->img_path) }}" 
                                alt="{{ $product->product_name }}" 
                                class="w-full h-24 object-cover rounded-md mb-1"
                                onerror="this.src='{{ asset('images/placeholder.jpg') }}'"
                            >
                        @else
                            <div class="w-full h-24 bg-gray-200 rounded-md mb-1 flex items-center justify-center">
                                <span class="text-gray-500 text-xs">No Image</span>
                            </div>
                        @endif
                        <h4 class="text-sm font-medium text-gray-800 truncate">{{ $product->product_name }}</h4>
                        <p class="text-gray-600 text-xs mt-1 truncate">{{ Str::limit($product->description, 30) }}</p>
                        <p class="text-blue-600 font-semibold text-xs mt-1">${{ number_format($product->discounted_price ?? $product->regular_price, 2) }}</p>
                        <form action="{{ route('cart.add') }}" method="POST" onclick="event.stopPropagation();">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="mt-1 w-full bg-blue-500 text-white px-2 py-1 text-xs rounded hover:bg-blue-600">
                                Add to Cart
                            </button>
                        </form>
                    </a>
                @endforeach
            </div>
        </div>

        {{-- Right Column: Cart and Stores --}}
        <div class="flex flex-col gap-8">
            {{-- Cart Section --}}
            <div class="bg-white rounded-xl shadow-md p-4 border border-gray-100">
                <h2 class="text-xl font-semibold text-gray-800 mb-2">
                    <svg class="inline-block w-6 h-6 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    Your Cart
                </h2>
                <a 
                    href="/user/cart" 
                    class="w-full block text-center bg-gradient-to-r from-blue-500 to-purple-600 text-white py-2 rounded-md hover:opacity-90 transition duration-300 text-sm"
                >
                    View Cart ({{ session('cart', []) ? count(session('cart')) : 0 }})
                </a>
                <p class="text-xs text-gray-500 mt-2 text-center">
                    Checkout and payment modules coming soon!
                </p>
            </div>

            {{-- Stores Section --}}
            <div class="bg-white rounded-xl shadow-md p-4 border border-gray-100">
                <h2 class="text-xl font-semibold text-gray-800 mb-2">
                    <svg class="inline-block w-6 h-6 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a2 2 0 012-2h2a2 2 0 012 2v5m-4-10h1"></path>
                    </svg>
                    Stores
                </h2>
                <div class="space-y-2">
                    @foreach(\App\Models\Store::inRandomOrder()->limit(5)->get() as $store)
                        <a 
                            href="{{ route('customer.products', ['store' => $store->id]) }}" 
                            class="block bg-gray-100 p-2 rounded-md text-gray-800 hover:bg-blue-100 hover:text-blue-700 transition duration-300 text-sm truncate"
                        >
                            {{ $store->store_name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- Categories Section --}}
    <div class="mt-12 bg-white rounded-xl shadow-md p-6 border border-gray-100">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6 flex items-center">
            <svg class="w-8 h-8 mr-3 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
            </svg>
            Browse by Category
        </h2>
        
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
            @foreach(\App\Models\Catagory::all() as $catagory)
                <a 
                    href="{{ route('customer.products', ['catagory' => $catagory->id]) }}" 
                    class="bg-gray-100 hover:bg-blue-100 text-gray-800 hover:text-blue-700 rounded-lg p-4 text-center transition duration-300 transform hover:-translate-y-1 hover:shadow-md"
                >
                    <span class="font-medium">{{ $catagory->catagory_name }}</span>
                </a>
            @endforeach
        </div>
    </div>

    {{-- Advanced Filters Section --}}
    <div class="mt-12 bg-white rounded-xl shadow-md p-6 border border-gray-100">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6 flex items-center">
            <svg class="inline-block w-8 h-8 mr-3 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
            </svg>
            Advanced Filters
        </h2>
        <form action="{{ route('customer.products') }}" method="GET" class="space-y-6">
            <!-- Search -->
            <div>
                <label class="block text-gray-700 mb-2">Search</label>
                <input 
                    type="text" 
                    name="search" 
                    placeholder="Search products..." 
                    class="w-full p-2 border rounded text-black focus:outline-none focus:border-blue-500"
                >
            </div>

            <!-- Category -->
            <div>
                <label class="block text-gray-700 mb-2">Category</label>
                <select 
                    name="catagory" 
                    class="w-full p-2 border rounded text-black focus:outline-none focus:border-blue-500"
                >
                    <option value="">All Categories</option>
                    @foreach(\App\Models\Catagory::all() as $catagory)
                        <option value="{{ $catagory->id }}">{{ $catagory->catagory_name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Subcategory -->
            <div>
                <label class="block text-gray-700 mb-2">Subcategory</label>
                <select name="subcatagory" class="w-full p-2 border rounded text-black focus:outline-none focus:border-blue-500">
                    <option value="">All Subcategories</option>
                    @foreach(\App\Models\SubCatagory::all() as $subcatagory)
                        <option value="{{ $subcatagory->id }}">{{ $subcatagory->subcatagory_name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Price Range -->
            <div>
                <label class="block text-gray-700 mb-2">Price Range</label>
                <input 
                    type="number" 
                    name="min_price" 
                    placeholder="Min Price" 
                    class="w-full p-2 border rounded text-black focus:outline-none focus:border-blue-500 mb-2"
                >
                <input 
                    type="number" 
                    name="max_price" 
                    placeholder="Max Price" 
                    class="w-full p-2 border rounded text-black focus:outline-none focus:border-blue-500"
                >
            </div>

            <!-- Stock Status -->
            <div>
                <label class="block text-gray-700 mb-2">Stock Status</label>
                <select name="stock_status" class="w-full p-2 border rounded text-black focus:outline-none focus:border-blue-500">
                    <option value="">Any</option>
                    <option value="In stock">In Stock</option>
                    <option value="Out of stock">Out of Stock</option>
                </select>
            </div>

            <!-- Store -->
            <div>
                <label class="block text-gray-700 mb-2">Store</label>
                <select name="store" class="w-full p-2 border rounded text-black focus:outline-none focus:border-blue-500">
                    <option value="">All Stores</option>
                    @foreach(\App\Models\Store::all() as $store)
                        <option value="{{ $store->id }}">{{ $store->store_name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Apply Filters</button>
        </form>
    </div>
</div>
@endsection