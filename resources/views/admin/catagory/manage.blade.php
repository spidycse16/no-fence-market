@extends('admin.layouts.layout')
@section('admin_page_title')
Manage Catagory - Admin
@endsection
@section('admin_layout')
<div class="card">
    @if(@session('message'))
    <div class="alert alert-success">
        {{session('message')}}
    </div>
    @endif
    <div class="card-header">
        <h5 class="card-title mb-0">All Catagories</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Catagory Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($catagories as $cat)
                    <tr>
                        <td>{{$cat->id}}</td>
                        <td>{{$cat->catagory_name}}</td>
                        <td>
                            <a href="/admin/catagory/{{$cat->id}}" class="btn btn-primary">Edit</a>
                            <form action="{{route('delete.catagory',$cat->id)}}" method="POST" style="display: inline;">
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