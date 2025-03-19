@extends('admin.layouts.layout')
@section('admin_page_title')
Edit Catagory - Admin
@endsection
@section('admin_layout')
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Edit Catagory</h5>
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

        <form action="{{route('update.catagory',$catagory_info->id)}}" method="POST">
        @csrf
        @method('PUT')
        <label for="catagory_name" class="fw-bold mb-2">Catagory Name :</label>
        <input type="text" name="catagory_name" class="form-control" value="{{$catagory_info->catagory_name}}">
        <button type="submit"  class="btn btn-primary w-100 mt-3">Edit Catagory</button>
    </form>
    </div>
</div>

@endsection