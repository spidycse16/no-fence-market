<?php

namespace App\Http\Controllers;

use App\Models\Subcatagory;
use Illuminate\Http\Request;

class MasterSubcatagoryController extends Controller
{
    public function storeSubcat(Request $request)
    {
        $validate_data=$request->validate([
            'subcatagory_name'=>'unique:subcatagories|max:100',
            'catagory_id' => 'required|exists:catagories,id',
        ]);
        $subcatagory=SubCatagory::create($validate_data);

        if($subcatagory)
        return redirect()->back()->with('success','Subcategory Added Successfully');
    }
}
