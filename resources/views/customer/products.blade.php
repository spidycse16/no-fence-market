<!-- resources/views/customer/products.blade.php -->
@extends('layouts.customer')
@section('title', 'Products')
@section('content')
    <div class="mb-8 flex flex-col md:flex-row">
        <!-- Filter Sidebar -->
        <div class="md:w-1/4 bg-white p-6 rounded shadow-md mb-6 md:mb-0 md:mr-6">
            <h2 class="text-xl font-semibold mb-4">Filters</h2>
            <form action="{{ route('customer.products') }}" method="GET" class="space-y-6">
                <!-- Search -->
                <div>
                    <label class="block text-gray-700 mb-2">Search</label>
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ $filters['search'] ?? '' }}" 
                        placeholder="Search products..." 
                        class="w-full p-2 border rounded text-black focus:outline-none focus:border-blue-500"
                    >
                </div>

                <!-- Category Dropdown with Onchange -->
                <div>
                    <label class="block text-gray-700 mb-2">Category</label>
                    <select 
                        name="catagory" 
                        class="w-full p-2 border rounded text-black focus:outline-none focus:border-blue-500"
                        onchange="this.form.submit()"
                    >
                        <option value="">All Categories</option>
                        @foreach($catagories as $catagory)
                            <option value="{{ $catagory->id }}" {{ ($filters['catagory'] ?? '') == $catagory->id ? 'selected' : '' }}>
                                {{ $catagory->catagory_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Clickable Category Links -->
                <div class="mt-4">
                    <h3 class="text-lg font-semibold mb-2">Browse Categories</h3>
                    <ul class="space-y-2">
                        <li>
                            <a 
                                href="{{ route('customer.products') }}" 
                                class="text-blue-500 hover:underline {{ empty($filters['catagory']) ? 'font-bold' : '' }}"
                            >
                                All Categories
                            </a>
                        </li>
                        @foreach($catagories as $catagory)
                            <li>
                                <a 
                                    href="{{ route('customer.products', ['catagory' => $catagory->id]) }}" 
                                    class="text-blue-500 hover:underline {{ ($filters['catagory'] ?? '') == $catagory->id ? 'font-bold' : '' }}"
                                >
                                    {{ $catagory->catagory_name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Subcategory -->
                <div>
                    <label class="block text-gray-700 mb-2">Subcategory</label>
                    <select name="subcatagory" class="w-full p-2 border rounded text-black focus:outline-none focus:border-blue-500">
                        <option value="">All Subcategories</option>
                        @foreach(\App\Models\SubCatagory::all() as $subcatagory)
                            <option value="{{ $subcatagory->id }}" {{ ($filters['subcatagory'] ?? '') == $subcatagory->id ? 'selected' : '' }}>
                                {{ $subcatagory->subcatagory_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Price Range -->
                <div>
                    <label class="block text-gray-700 mb-2">Price Range</label>
                    <input 
                        type="number" 
                        name="min_price" 
                        value="{{ $filters['min_price'] ?? '' }}" 
                        placeholder="Min Price" 
                        class="w-full p-2 border rounded text-black focus:outline-none focus:border-blue-500 mb-2"
                    >
                    <input 
                        type="number" 
                        name="max_price" 
                        value="{{ $filters['max_price'] ?? '' }}" 
                        placeholder="Max Price" 
                        class="w-full p-2 border rounded text-black focus:outline-none focus:border-blue-500"
                    >
                </div>

                <!-- Stock Status -->
                <div>
                    <label class="block text-gray-700 mb-2">Stock Status</label>
                    <select name="stock_status" class="w-full p-2 border rounded text-black focus:outline-none focus:border-blue-500">
                        <option value="">Any</option>
                        <option value="In stock" {{ ($filters['stock_status'] ?? '') == 'In stock' ? 'selected' : '' }}>In Stock</option>
                        <option value="Out of stock" {{ ($filters['stock_status'] ?? '') == 'Out of stock' ? 'selected' : '' }}>Out of Stock</option>
                    </select>
                </div>

                <!-- Store -->

                <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Apply Filters</button>
            </form>
        </div>

        <!-- Product Listing -->
        <div class="flex-1">
            <h1 class="text-3xl font-bold mb-4">Our Products</h1>

            @if(session('success'))
                <div class="bg-green-100 text-green-800 p-4 rounded mb-6 text-center">
                    {{ session('success') }}
                </div>
            @endif

            @if($products->isEmpty())
                <p class="text-gray-600">No products found matching your filters.</p>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    @foreach($products as $product)
                        <a href="{{ route('customer.product.show', $product->id) }}" class="block bg-white p-4 rounded shadow hover:shadow-lg transition">
                            <div>
                                @if($product->images->isNotEmpty())
                                    <?php $primaryImage = $product->images->where('its_primary', 1)->first() ?? $product->images->first(); ?>
                                    <img 
                                        src="{{ asset('storage/' . $primaryImage->img_path) }}" 
                                        alt="{{ $product->product_name }}" 
                                        class="w-full h-48 object-cover rounded mb-4"
                                        onerror="this.src='{{ asset('images/placeholder.jpg') }}'"
                                    >
                                @else
                                    <div class="w-full h-48 bg-gray-200 rounded mb-4 flex items-center justify-center">
                                        <span class="text-gray-500">No Image</span>
                                    </div>
                                @endif

                                <h3 class="text-lg font-semibold mb-2">{{ $product->product_name }}</h3>
                                <p class="text-gray-600 mb-1">${{ $product->discounted_price ?? $product->regular_price }}</p>
                                <p class="text-sm text-gray-500 mb-1">Store: {{ $product->store->store_name }}</p>
                                <p class="text-sm text-gray-500 mb-2">
                                    {{ $product->catagory->catagory_name }} > {{ $product->subCatagory->subcatagory_name }}
                                </p>
                                <form action="{{ route('cart.add') }}" method="POST" onclick="event.stopPropagation();">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                        Add to Cart
                                    </button>
                                </form>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection