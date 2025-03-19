@extends('admin.layouts.layout')
@section('admin_page_title')
Manage SubCategory - Admin
@endsection
@section('admin_layout')
<div class="card">
    @if(session('message'))
    <div class="alert alert-success">
        {{session('message')}}
    </div>
    @endif
    <div class="card-header">
        <h5 class="card-title mb-0">All SubCategories</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>SubCategory</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subcatagories as $subcat)
                    <tr>
                        <td>{{$subcat->id}}</td>
                        <td>{{$subcat->subcatagory_name}}</td>
                        <td>{{$subcat->catagory->catagory_name}}</td>
                        <td>
                            <a href="" class="btn btn-primary">Edit</a>
                            <form action="" method="POST" style="display: inline;">
                                @csrf
                                @method('delete')
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