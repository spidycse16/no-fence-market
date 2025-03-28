@extends('layouts.customer')

@section('title', 'Become a Vendor')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg p-8">
        <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Vendor Registration Request</h1>
        
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        {{ session('success') }}
    </div>
@endif
        <form action="{{route('vendor.approve')}}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Full Name* (as per NID):</label>
                    <input type="text" name="full_name" required 
                           class="block w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">NID Card Number*:</label>
                    <input type="text" name="nid_number" required 
                           class="block w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email Address*:</label>
                    <input type="email" name="email" required 
                           class="block w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Personal Phone Number*:</label>
                    <input type="tel" name="personal_phone" required 
                           class="block w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Mobile Banking Number*:</label>
                    <input type="text" name="mobile_banking_no" required 
                           class="block w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Business Type*:</label>
                    <select name="business_type" required 
                            class="block w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Select Business Type</option>
                        <option value="entrepreneur">Entrepreneur</option>
                        <option value="shopkeeper">Shopkeeper</option>
                        <option value="farmer">Farmer</option>
                        <option value="businessman">Businessman</option>
                        <option value="home_baker">Home Baker</option>
                        <option value="handicraft_artisan">Handicraft Artisan</option>
                        <option value="freelancer">Freelancer</option>
                        <option value="manufacturer">Manufacturer</option>
                        <option value="service_provider">Service Provider</option>
                        <option value="other">Other</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">NID Card Front Page*:</label>
                    <input type="file" name="nid_front_page" required 
                           class="block w-full text-sm text-gray-500 
                           file:mr-4 file:px-4 file:py-2 file:rounded-lg file:border-0 
                           file:text-sm file:bg-blue-500 file:text-white 
                           hover:file:bg-blue-600 
                           border-2 border-gray-300 rounded-lg 
                           focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tax Identification Number (TIN):</label>
                    <input type="text" name="tin_number"
                           class="block w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
            </div>

            <div class="flex items-center space-x-3">
                <input type="checkbox" name="terms_agreement" required 
                       class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                <label class="text-sm text-gray-900">
                    I agree to the Vendor Terms of Service and certify that the information provided is accurate
                </label>
            </div>

            <div class="text-center">
                <button type="submit" 
                        class="inline-flex justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-300 ease-in-out">
                    Submit Vendor Request
                </button>
            </div>
        </form>
    </div>
</div>
@endsection