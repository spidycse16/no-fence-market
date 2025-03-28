@extends('admin.layouts.layout')
@section('admin_page_title')
Approve Vendors - Admin
@endsection
@section('admin_layout')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Unapproved Vendors</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
    <!-- Header -->
    <header class="bg-blue-600 text-white p-4 shadow-md">
        <div class="container mx-auto">
            <h1 class="text-2xl font-bold">Admin Dashboard - Unapproved Vendors</h1>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto py-8">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if($vendors->isEmpty())
            <p class="text-gray-600 text-center">No unapproved vendors found.</p>
        @else
            <div class="bg-white shadow-md rounded-lg overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Full Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NID Number</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Personal Phone</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mobile Banking No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Business Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NID Document</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">TIN Number</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($vendors as $vendor)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $vendor->user_id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $vendor->full_name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $vendor->nid_number }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $vendor->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $vendor->personal_phone }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $vendor->mobile_banking_no }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $vendor->business_type }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($vendor->nid_document_path)
                                        <a href="{{ asset('storage/' . $vendor->nid_document_path) }}" target="_blank" class="text-blue-500 hover:underline">View</a>
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $vendor->tin_number ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $vendor->status }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <form action="{{ route('admin.vendor.approve', $vendor->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">Approve</button>
                                    </form>
                                    <form action="{{ route('admin.vendor.reject', $vendor->id) }}" method="POST" class="inline ml-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Reject</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white p-6">
        <div class="container mx-auto text-center">
            <p>© {{ date('Y') }} No Fence Market Admin. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>

@endsection