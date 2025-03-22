@extends('admin.layouts.layout')
@section('admin_page_title')
Edit ProductAttribute - Admin
@endsection
@section('admin_layout')
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Edit Product Attribute</h5>
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

        <form action="{{route('update.attribute',$attribute_info->id)}}" method="POST">
        @csrf
        @method('PUT')
        <label for="attribute_value" class="fw-bold mb-2">Attribute Name :</label>
        <input type="text" name="attribute_value" class="form-control" value="{{$attribute_info->attribute_value}}">
        <button type="submit"  class="btn btn-primary w-100 mt-3">Edit Attribute</button>
    </form>
    </div>
</div>

@endsection