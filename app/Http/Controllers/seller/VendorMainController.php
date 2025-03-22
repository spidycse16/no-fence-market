<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VendorMainController extends Controller
{
    public function index()
    {
        return view('vendor.dashboard');
    }

    public function orderHistory()
    {
        return view('vendor.orderHistory');
    }
}
