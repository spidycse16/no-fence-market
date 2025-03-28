<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Catagory;
use App\Models\User;
use App\Models\Product;
use App\Models\VendorApproval;

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

    public function vendorRegister()
    {
        return view('customer.register_vendor');
    }
    public function profile()
    {
        return view('customer.profile');
    }

    public function vendorApprove(Request $request)
    {
     $validatedData = $request->validate([
         'full_name' => 'required|string|max:255',
         'nid_number' => 'required|string|unique:vendor_approvals,nid_number',
         'email' => 'required|email|unique:users,email',
         'personal_phone' => 'required|string|max:20',
         'mobile_banking_no' => 'required|string|max:20',
         'business_type' => 'required|in:entrepreneur,shopkeeper,farmer,businessman,home_baker,handicraft_artisan,freelancer,manufacturer,service_provider,other',
         'nid_front_page' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
         'tin_number' => 'string|max:50',
         'terms_agreement' => 'accepted'
     ]);
 
     // Store NID front page document
     $nidDocumentPath = $request->file('nid_front_page')->store('vendor_nid_documents', 'public');
 
     // Create vendor approval request
     $vendorRequest = VendorApproval::create([
         'user_id' => auth()->id(),
         'full_name' => $validatedData['full_name'],
         'nid_number' => $validatedData['nid_number'],
         'email' => $validatedData['email'],
         'personal_phone' => $validatedData['personal_phone'],
         'mobile_banking_no' => $validatedData['mobile_banking_no'],
         'business_type' => $validatedData['business_type'],
         'nid_document_path' => $nidDocumentPath,
         'tin_number' => $validatedData['tin_number'],
         'status' => 'pending'
     ]);
 
     // Optional: Send notification to admin
     // Notification::send($admin, new VendorRegistrationRequest($vendorRequest));
 
     return redirect()->back()->with('success', 'Your vendor registration request has been submitted successfully!');
 
    }
    
}