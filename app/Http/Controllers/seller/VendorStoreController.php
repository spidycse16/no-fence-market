<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use App\Models\Store;

class VendorStoreController extends Controller
{
    public function index()
    {
        return view('vendor.store.create');
    }
    public function manage()
    {
        $user_id=Auth::id();
        $stores=Store::where('user_id',$user_id)->get();
        return view('vendor.store.manage',compact('stores'));
    }

    public function publish(Request $request)
    {
        $request->validate([
            'store_name' => 'required|string|max:100',
            'details' => 'nullable|string',
            'slug' => 'required|string|unique:stores|max:255',
        ]);

        $store = new Store();
        $store->store_name = $request->store_name;
        $store->details = $request->details;
        $store->slug = $request->slug;
        $store->user_id = auth()->id(); 
    
        $store->save();
    
        return redirect()->back()->with('success', 'Store created successfully!');
    }
    public function edit($id)
{
    $store = Store::findOrFail($id);
    return view('vendor.store.edit', compact('store'));
}
public function delete($id)
{
    $store = Store::findOrFail($id);
    $store->delete();

    return redirect()->back()->with('message', 'Store deleted successfully!');
}
public function update(Request $request, $id)
{
    $request->validate([
        'store_name' => 'required|string|max:255',
        'details' => 'nullable|string',
        'slug' => 'required|string|unique:stores,slug,' . $id . '|max:255',
    ]);

    $store = Store::findOrFail($id);

    $store->update([
        'store_name' => $request->store_name,
        'details' => $request->details,
        'slug' => $request->slug,
    ]);

    return redirect()->back()->with('message', 'Store updated successfully!');
}

}
