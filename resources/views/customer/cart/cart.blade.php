<!-- resources/views/customer/cart.blade.php -->
@extends('layouts.customer')
@section('title', 'Your Cart')
@section('content')
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-center mb-6">Your Cart</h1>

        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded mb-6 text-center">
                {{ session('success') }}
            </div>
        @endif

        <!-- Cart Items -->
        @if(empty($cart))
            <p class="text-center text-gray-600">Your cart is empty. <a href="{{ route('customer.products') }}" class="text-blue-500 hover:underline">Start shopping!</a></p>
        @else
            <div class="bg-white p-6 rounded shadow-md">
                <div class="space-y-6">
                    @foreach($cart as $id => $item)
                        <div class="flex flex-col md:flex-row items-center justify-between border-b pb-4">
                            <!-- Image -->
                            <div class="w-full md:w-1/4 mb-4 md:mb-0">
                                @if($item['image'])
                                    <img 
                                        src="{{ asset('storage/' . $item['image']) }}" 
                                        alt="{{ $item['name'] }}" 
                                        class="w-full h-32 object-cover rounded"
                                        onerror="this.src='{{ asset('images/placeholder.jpg') }}'"
                                    >
                                @else
                                    <div class="w-full h-32 bg-gray-200 rounded flex items-center justify-center">
                                        <span class="text-gray-500">No Image</span>
                                    </div>
                                @endif
                            </div>

                            <!-- Product Info -->
                            <div class="flex-1 md:ml-4">
                                <h3 class="text-lg font-semibold">{{ $item['name'] }}</h3>
                                <p class="text-gray-600">${{ $item['price'] }}</p>
                            </div>

                            <!-- Quantity Update -->
                            <form action="{{ route('cart.update') }}" method="POST" class="flex items-center space-x-4">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $id }}">
                                <input 
                                    type="number" 
                                    name="quantity" 
                                    value="{{ $item['quantity'] }}" 
                                    min="1" 
                                    class="w-16 p-2 border rounded text-black focus:outline-none focus:ring-2 focus:ring-blue-500"
                                >
                                <button 
                                    type="submit" 
                                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200"
                                >
                                    Update
                                </button>
                            </form>

                            <!-- Remove -->
                            <form action="{{ route('cart.remove') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $id }}">
                                <button 
                                    type="submit" 
                                    class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition duration-200"
                                >
                                    Remove
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>

                <!-- Total and Checkout -->
                <div class="mt-6 text-right">
                    <p class="text-lg font-semibold">Total: ${{ $total }}</p>
                    <a href="#" class="mt-4 inline-block bg-green-500 text-white px-6 py-2 rounded hover:bg-green-600">Proceed to Checkout</a>
                    <p class="text-sm text-gray-500 mt-1">Checkout functionality coming soon!</p>
                </div>
            </div>
        @endif
    </div>
@endsection