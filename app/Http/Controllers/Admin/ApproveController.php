<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VendorApproval;
use App\Models\User;
class ApproveController extends Controller
{
    public function show()
    {
        $vendors = VendorApproval::where('status', 'pending')->get();
        return view('admin.approval.unapproved_vendors', compact('vendors'));
    }

    public function approve($id)
    {
        $vendor = VendorApproval::findOrFail($id);
        $user = User::where('id', $vendor->user_id)->first();
        if ($user) {
            $user->update(['role' => 1]);
            $vendor->update(['status'=>'approved']);
        } 
        
        else
        {
            return redirect()->back()->with('success','Login First');
        }
        return redirect()->route('admin.vendor.index')->with('success', 'Vendor approved successfully.');
    }

    public function reject($id)
    {
        $vendor = VendorApproval::findOrFail($id);
        $vendor->delete();

        return redirect()->route('admin.vendor.index')->with('success', 'Vendor rejected successfully.');
    }
}
