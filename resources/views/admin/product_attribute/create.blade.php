@extends('admin.layouts.layout')
@section('admin_page_title')
Create Dafault Attribute - Admin
@endsection
@section('admin_layout')
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Create Dafault Attribute</h5>
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
        @if(@session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
        @endif

        <form action="{{route('attribute.create')}}" method="POST">
        @csrf
        <label for="attribute_value" class="fw-bold mb-2">Enter Attribute value :</label>
        <input type="text" name="attribute value" class="form-control" placeholder="XL">
        <button type="submit"  class="btn btn-primary w-100 mt-3">Add Attribute</button>
    </form>
    </div>
</div>

@endsection