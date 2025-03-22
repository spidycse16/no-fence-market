@extends('vendor.layouts.layout')

@section('vendor_page_title')
Manage Store - vendor
@endsection

@section('vendor_layout')
<div class="card">
    @if(session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif

    <div class="card-header">
        <h5 class="card-title mb-0">My stores</h5>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Stores</th>
                        <th>Slug</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stores as $store)
                    <tr>
                        <td>{{ $store->id }}</td>
                        <td>{{ $store->store_name }}</td>
                        <td>{{ $store->slug }}</td>
                        <td>{{ $store->details }}</td>
                        <td>
                            <a href="{{ route('store.edit', $store->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('store.destroy', $store->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
