<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubCatagoryController extends Controller
{
    public function index()
    {
        return view('admin.sub_catagory.create');
    }

    public function manage()
    {
        return view('admin.sub_catagory.manage');
    }

}
