@extends('admin.layouts.layout')
@section('admin_page_title')
Create Catagory - Admin
@endsection
@section('admin_layout')
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Create Catagory</h5>
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

        <form action="/admin/store/catagory" method="POST">
        @csrf
        <label for="catagory_name" class="fw-bold mb-2">Catagory Name :</label>
        <input type="text" name="catagory_name" class="form-control" placeholder="Computer">
        <button type="submit"  class="btn btn-primary w-100 mt-3">Add Catagory</button>
    </form>
    </div>
</div>

@endsection