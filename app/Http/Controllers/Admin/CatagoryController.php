<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catagory;
use Illuminate\Http\Request;

class CatagoryController extends Controller
{
    public function index()
    {
        return view('admin.catagory.create');
    }
    public function manage()
    {
        $catagories=Catagory::all();
        return view('admin.catagory.manage',compact('catagories'));
    }
}
