<!-- resources/views/customer/product-details.blade.php -->
@extends('layouts.customer')
@section('title', $product->product_name)
@section('content')
    <div class="bg-white p-6 rounded shadow-md mb-8">
        <h1 class="text-3xl font-bold mb-4">{{ $product->product_name }}</h1>

        <!-- Product Images -->
        <div class="mb-6">
            @if($product->images->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($product->images as $image)
                        <img 
                            src="{{ asset('storage/' . $image->img_path) }}" 
                            alt="{{ $product->product_name }}" 
                            class="w-full h-64 object-cover rounded"
                            onerror="this.src='{{ asset('images/placeholder.jpg') }}'"
                        >
                    @endforeach
                </div>
            @else
                <div class="w-full h-64 bg-gray-200 rounded flex items-center justify-center">
                    <span class="text-gray-500">No Image</span>
                </div>
            @endif
        </div>

        <!-- Product Info -->
        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-2">Product Details</h2>
            <p class="text-gray-600 mb-2"><strong>Description:</strong> {{ $product->description }}</p>
            <p class="text-gray-600 mb-2"><strong>Regular Price:</strong> ${{ $product->regular_price }}</p>
            @if($product->discounted_price)
                <p class="text-gray-600 mb-2"><strong>Discounted Price:</strong> ${{ $product->discounted_price }}</p>
            @endif
            <p class="text-gray-600 mb-2"><strong>Stock:</strong> {{ $product->stock_quantity }} ({{ $product->stock_status }})</p>
            <p class="text-gray-600 mb-2"><strong>Category:</strong> {{ $product->catagory->catagory_name }}</p>
            <p class="text-gray-600 mb-2"><strong>Subcategory:</strong> {{ $product->subCatagory->subcatagory_name }}</p>
            <p class="text-gray-600 mb-2"><strong>SKU:</strong> {{ $product->sku }}</p>
            <p class="text-gray-600 mb-2"><strong>Status:</strong> {{ $product->status }}</p>
        </div>

        <!-- Shop Info -->
        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-2">Shop Details</h2>
            <p class="text-gray-600 mb-2"><strong>Store Name:</strong> {{ $product->store->store_name }}</p>
            <p class="text-gray-600 mb-2"><strong>Details:</strong> {{ $product->store->details }}</p>
            <!-- Add more store fields if available (e.g., location) -->
        </div>

        <!-- Add to Cart -->
        <form action="/cart/add" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
                Add to Cart
            </button>
        </form>
    </div>
@endsection