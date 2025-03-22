@extends('vendor.layouts.layout')

@section('vendor_page_title')
Edit Store - vendor
@endsection

@section('vendor_layout')
<div class="card">
    @if(session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif
    <div class="card-header">
        <h5 class="card-title mb-0">Edit Store</h5>
    </div>
    <div class="card-body">
        @if($errors->any())
        <div class="alert alert-danger fade show">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ route('store.update', $store->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="store_name" class="fw-bold mb-2">Store Name :</label>
            <input type="text" name="store_name" class="form-control" value="{{ old('store_name', $store->store_name) }}" placeholder="Store Name">

            <label for="details" class="fw-bold mb-2">Description :</label>
            <textarea id="details" cols="5" name="details" class="form-control" placeholder="Description">{{ old('details', $store->details) }}</textarea>

            <label for="slug" class="fw-bold mb-2">Slug :</label>
            <input type="text" name="slug" class="form-control" value="{{ old('slug', $store->slug) }}" placeholder="Store Slug">

            <button type="submit" class="btn btn-primary w-100 mt-3">Update Store</button>
        </form>
    </div>
</div>
@endsection
