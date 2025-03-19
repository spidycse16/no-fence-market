<?php

namespace App\Http\Controllers;

use App\Models\Catagory;
use Illuminate\Http\Request;

class MasterCatagoryController extends Controller
{
    public function storeCatagory(Request $request)
    {
        $validate_data=$request->validate([
            'catagory_name'=>'unique:catagories|max:100',
        ]);
        $catagory=Catagory::create($validate_data);

        if($catagory)
        return redirect()->back()->with('success','Catagory Added Successfully');
    }

    public function showCat($id)
    {
        $catagory_info=Catagory::find($id);
        return view('admin.catagory.edit',compact('catagory_info'));
    }
    public function updateCat(Request $request,$id)
    {
        $catagory=Catagory::findOrFail($id);
        $validate_data=$request->validate([
            'catagory_name'=>'unique:catagories|max:100',
        ]);
        $catagory->update($validate_data);
        return redirect()->back()->with('message','Category Updated Successfully');
    }

    public function deleteCat($id)
    {
        Catagory::findOrFail($id)->delete();
        return redirect()->back()->with('message','Category Deleted Successfully');
    }
}
