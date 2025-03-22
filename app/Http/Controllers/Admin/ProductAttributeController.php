<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DefaultAttribute;
use Illuminate\Http\Request;

class ProductAttributeController extends Controller
{
    public function index()
    {
      
        return view('admin.product_attribute.create');
    }
    public function manage()
    {
        $allattributes=DefaultAttribute::all();
        return view('admin.product_attribute.manage',compact('allattributes'));
    }

    public function createAttribute(Request $request)
    {
        $validate_data=$request->validate([
            'attribute_value'=>'unique:default_attributes|max:100',
        ]);
        $attributes=DefaultAttribute::create($validate_data);

        if($attributes)
        return redirect()->back()->with('success','ProductAttribute Added Successfully');
    }

    public function showAttribute($id)
    {
        $attribute_info=DefaultAttribute::find($id);
        return view('admin.product_attribute.edit',compact('attribute_info'));
    }
    public function updateAttribute(Request $request,$id)
    {
        $attribute=DefaultAttribute::find($id);
        $validate_data=$request->validate([
            'attribute_value'=>'unique:default_attributes|max:100',
        ]);
        $attribute->update($validate_data);
        return redirect()->back()->with('message','Attribute Updated Successfully');
    }

    public function deleteAttribute($id)
    {
        DefaultAttribute::findOrFail($id)->delete();
        return redirect()->back()->with('message','Attribute Deleted Successfully');
    }
    
}
