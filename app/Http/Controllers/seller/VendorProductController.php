<?php

namespace App\Http\Controllers\Seller;
use App\Models\ProductImage;
use Auth;
use App\Models\Store;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VendorProductController extends Controller
{
    public function index()
    {
        $user_id=Auth::id();
        $stores=Store::where('user_id',$user_id)->get();
        return view('vendor.product.create',compact('stores'));
    }
    public function manage()
    {
        return view('vendor.product.manage');
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sku' => 'required|string|max:255|unique:products,sku',
            'catagory_id' => 'required|exists:catagories,id',
            'subcatagory_id' => 'required|exists:subcatagories,id',
            'store_id' => 'required|exists:stores,id',
            'regular_price' => 'required|numeric|min:0',
            'discounted_price' => 'nullable|numeric|min:0|lt:regular_price',
            'tax_rate' => 'nullable|numeric|min:0|max:100',
            'slug' => 'required|string|max:255',
            'stock_quantity' => 'required|integer|min:0',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

            $product=Product::create([
            'product_name'=>$request->product_name,
            'description'=>$request->description,
            'sku'=>$request->sku,
            'seller_id'=>Auth::id(),
            'catagory_id'=>$request->catagory_id,
            'subcatagory_id'=>$request->subcatagory_id,
            'store_id'=>$request->store_id,
            'regular_price'=>$request->regular_price,
            'discounted_price'=>$request->discounted_price,
            'tax_rate'=>$request->tax_rate,
            'stock_quantity'=>$request->stock_quantity,
            'slug'=>$request->slug,
            'meta_title'=>$request->meta_title,
            'meta_description'=>$request->meta_description,
        ]);

        if($request->hasFile('images'))
        {
            foreach($request->file('images') as $file)
            {
                $path=$file->store('product_images','public');
                ProductImage::create([
                    'product_id'=>$product->id,
                    'img_path'=>$path,
                    'is_primary'=>false,
                ]);
            }
        }
        return redirect()->back()->with('success','Product Added Successfully');
    }
}
