<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VendorProductController extends Controller
{
    public function index()
    {
        return view('vendor.product.create');
    }
    public function manage()
    {
        return view('vendor.product.manage');
    }
}
