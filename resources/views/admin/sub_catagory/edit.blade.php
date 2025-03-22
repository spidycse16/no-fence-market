@extends('admin.layouts.layout')
@section('admin_page_title')
Edit SubCategory - Admin
@endsection
@section('admin_layout')
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Edit SubCategory</h5>
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
        @if(@session('message'))
        <div class="alert alert-success">
            {{session('message')}}
        </div>
        @endif

        <form action="{{route('update.subcatagory',$subcatagory_info->id)}}" method="POST">
        @csrf
        @method('PUT')
        <label for="subcatagory_name" class="fw-bold mb-2">SubCategory Name :</label>
        <input type="text" name="subcatagory_name" class="form-control" value="{{$subcatagory_info->subcatagory_name}}">
        <button type="submit"  class="btn btn-primary w-100 mt-3">Update SubCategory</button>
    </form>
    </div>
</div>

@endsection