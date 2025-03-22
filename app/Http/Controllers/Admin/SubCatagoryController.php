<?php

namespace App\Http\Controllers\Admin;
use App\Models\Catagory;
use App\Http\Controllers\Controller;
use App\Models\Subcatagory;
use Illuminate\Http\Request;

class SubCatagoryController extends Controller
{
    public function index()
    {
        $catagories=Catagory::all();
        return view('admin.sub_catagory.create',compact('catagories'));
    }

    public function manage()
    {
        $subcatagories=Subcatagory::all();
        return view('admin.sub_catagory.manage',compact('subcatagories'));
    }
    

}
