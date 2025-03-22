@extends('vendor.layouts.layout')
@section('vendor_page_title')
Create New Store - vendor
@endsection
@section('vendor_layout')
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Create Store</h5>
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
        @if(session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
        @endif

        <form action="{{route('store.publish')}}" method="POST">
        @csrf
        <label for="store_name" class="fw-bold mb-2">Create Store :</label>
        <input type="text" name="store_name" class="form-control" placeholder="ABC Traders">
        <label for="details" class="fw-bold mb-2">Description :</label>
        <textarea id="details" cols="5" name="details" class="form-control" placeholder="---"></textarea>

        <label for="slug" class="fw-bold mb-2">Slug :</label>
        <input type="text" name="slug" class="form-control" placeholder="">
        <button type="submit" class="btn btn-primary w-100 mt-3">Create Store</button>
    </form>
    </div>
</div>

@endsection
