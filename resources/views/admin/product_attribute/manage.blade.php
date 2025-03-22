@extends('admin.layouts.layout')
@section('admin_page_title')
Manage Attributes - Admin
@endsection
@section('admin_layout')
<div class="card">
    @if(@session('message'))
    <div class="alert alert-success">
        {{session('message')}}
    </div>
    @endif
    <div class="card-header">
        <h5 class="card-title mb-0">All Attributes</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Attributes</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($allattributes as $attribute)
                    <tr>
                        <td>{{$attribute->id}}</td>
                        <td>{{$attribute->attribute_value}}</td>
                        <td>
                            <a href="{{route('show.attribute',$attribute->id)}}" class="btn btn-primary">Edit</a>
                            <form action="{{route('delete.attribute',$attribute->id)}}" method="POST" style="display: inline;">
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