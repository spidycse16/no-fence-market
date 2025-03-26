<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Catagory;
use App\Models\User;
use App\Models\Product;

class CustomerMainController extends Controller
{
    public function index()
    {
        return view('customer.welcome');
    }

    public function orderHistory()
    {
        return view('customer.history');
    }

    public function payment()
    {
        return view('customer.payment');
    }

    public function affiliate()
    {
        return view('customer.affiliate');
    }

    public function products(Request $request)
    {
        $products = $this->filterProducts($request);
        $catagories = Catagory::all();

        $filters = $request->only(['search', 'catagory', 'subcatagory', 'min_price', 'max_price', 'stock_status', 'store']);

        // Optional: Debug to verify filters
        // dd($request->all(), $products->toArray());

        return view('customer.products', compact('products', 'catagories', 'filters'));
    }

    public function show($id)
    {
        $product = Product::with(['catagory', 'subCatagory', 'store', 'images'])->findOrFail($id);
        return view('customer.product-details', compact('product'));
    }

    public function search(Request $request)
    {
        $products = $this->filterProducts($request);
        $catagories = Catagory::all();

        $filters = $request->only(['search', 'catagory', 'subcatagory', 'min_price', 'max_price', 'stock_status', 'store']);

        // Optional: Debug to verify filters
        // dd($request->all(), $products->toArray());

        return view('customer.search', compact('products', 'catagories', 'filters'));
    }

    public function autocomplete(Request $request)
    {
        $query = $request->query('query');
        $products = Product::where('product_name', 'like', '%' . $query . '%')
            ->pluck('product_name')
            ->take(5)
            ->toArray();

        return response()->json($products);
    }

    private function filterProducts(Request $request)
    {
        $search = $request->query('search');
        $catagory_id = $request->query('catagory');
        $subcatagory_id = $request->query('subcatagory');
        $min_price = $request->query('min_price');
        $max_price = $request->query('max_price');
        $stock_status = $request->query('stock_status');
        $store_id = $request->query('store');

        return Product::query()
            ->when($search, function ($query) use ($search) {
                return $query->where('product_name', 'like', '%' . $search . '%');
            })
            ->when($catagory_id, function ($query) use ($catagory_id) {
                return $query->where('catagory_id', $catagory_id);
            })
            ->when($subcatagory_id, function ($query) use ($subcatagory_id) {
                return $query->where('subcatagory_id', $subcatagory_id);
            })
            ->when($min_price, function ($query) use ($min_price) {
                return $query->where(function ($q) use ($min_price) {
                    $q->where('discounted_price', '>=', $min_price)
                      ->orWhereNull('discounted_price')
                      ->where('regular_price', '>=', $min_price);
                });
            })
            ->when($max_price, function ($query) use ($max_price) {
                return $query->where(function ($q) use ($max_price) {
                    $q->where('discounted_price', '<=', $max_price)
                      ->orWhereNull('discounted_price')
                      ->where('regular_price', '<=', $max_price);
                });
            })
            ->when($stock_status, function ($query) use ($stock_status) {
                return $query->where('stock_status', $stock_status);
            })
            ->when($store_id, function ($query) use ($store_id) {
                return $query->where('store_id', $store_id);
            })
            ->with(['catagory', 'subCatagory', 'store', 'images'])
            ->get();
    }
}