@extends('admin.layouts.layout')
@section('admin_page_title')
Create SubCategory - Admin
@endsection
@section('admin_layout')
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Create SubCatagory</h5>
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
        
        <form action="/admin/store/subcatagory" method="POST">
        @csrf
        <label for="subcatagory_name" class="fw-bold mb-2">SubCatagory Name :</label>
        <input type="text" name="subcatagory_name" class="form-control" placeholder="Computer">
        
        <label for="catagory_id" class="fw-bold mb-2 mt-3">Please select the Category</label>
        <select name="catagory_id" id="catagory_id" class="form-control">
            @foreach ($catagories as $cat)
            <option value="{{$cat->id}}">{{$cat->catagory_name}}</option>
            @endforeach
        </select>
        
        <button type="submit" class="btn btn-primary w-100 mt-3">Add SubCategory</button>
    </form>
    </div>
</div>
@endsection