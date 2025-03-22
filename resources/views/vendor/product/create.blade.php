@extends('vendor.layouts.layout')
@section('vendor_page_title')
Add Product - vendor
@endsection
@section('vendor_layout')
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Add Product</h5>
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
        
        <form action="{{route('vendor.product.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="product_name" class="fw-bold mb-2">Product Name :</label>
        <input type="text" name="product_name" class="form-control mb-2" placeholder="Rice">
        
        <label for="description" class="fw-bold mb-2">Description :</label>
        <textarea name="description" class="form-control mb-2"></textarea>

        <label for="images" class="fw-bold mb-2">Upload Product Images :</label>
        <input type="file" name="images[]" class="form-control mb-2" multiple>
        
        <label for="sku" class="fw-bold mb-2">SKU :</label>
        <input type="text" name="sku" class="form-control mb-2" placeholder="PRD-001">
        <livewire:catagory-subcatagory />
        
        <label for="store_id" class="fw-bold mb-2">Select your Store :</label>
        <select name="store_id" id="store_id" class="form-control mb-2">
            @foreach ($stores as $store)
                <option value="{{$store->id}}">{{$store->store_name}}</option>
            @endforeach
        </select>
        
        <label for="regular_price" class="fw-bold mb-2">Regular Price :</label>
        <input type="number"  name="regular_price" class="form-control mb-2" placeholder="100.00">
        
        <label for="discounted_price" class="fw-bold mb-2">Discounted Price (If any) :</label>
        <input type="number"  name="discounted_price" class="form-control mb-2" placeholder="90.00">
        
        <label for="tax_rate" class="fw-bold mb-2">Tax Rate(In percent) :</label>
        <input type="number"  name="tax_rate" class="form-control mb-2" placeholder="5.00">
        
        <label for="stock_quantity" class="fw-bold mb-2">Stock Quantity :</label>
        <input type="number" name="stock_quantity" class="form-control mb-2" placeholder="100">
        
        
        <label for="slug" class="fw-bold mb-2">Slug :</label>
        <input type="text" name="slug" class="form-control mb-2" placeholder="product-name123">
        
        
        <label for="meta_title" class="fw-bold mb-2">Meta Title :</label>
        <input type="text" name="meta_title" class="form-control mb-2" placeholder="Product Meta Title">
        
        <label for="meta_description" class="fw-bold mb-2">Meta Description :</label>
        <textarea name="meta_description" class="form-control mb-2"></textarea>
        
        <button type="submit" class="btn btn-primary w-100 mt-3">Add Product</button>
    </form>
    </div>
</div>
@endsection