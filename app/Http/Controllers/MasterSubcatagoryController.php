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

    public function showSubcat($id)
    {
        $subcatagory_info=Subcatagory::find($id);
        return view('admin.sub_catagory.edit',compact('subcatagory_info'));
    }
    public function updateSubcat(Request $request,$id)
    {
        $subcatagory=Subcatagory::findOrFail($id);
        $validate_data=$request->validate([
            'subcatagory_name'=>'unique:subcatagories|max:100',
        ]);
        $subcatagory->update($validate_data);
        return redirect()->back()->with('message','SubCategory Updated Successfully');
    }

    public function deleteSubcat($id)
    {
        SubCatagory::findOrFail($id)->delete();
        return redirect()->back()->with('message','SubCategory Deleted Successfully');
    }
}
