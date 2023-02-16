<?php

namespace App\Http\Controllers\Jpanel\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\VendorDetail;


class VendorDetailController extends Controller
{
    //
    public function index()
    {
        $vendors = VendorDetail::all();
        $hasPermission = hasPermission('vendors', 2);
        if ($hasPermission)
            return view('jpanel.vendor.index', ['vendors' => $vendors]);
        else
            abort(403);
    }

    public function createVendor(Request $request)
    {

        $hasPermission = hasPermission('vendors', 1);
        if ($hasPermission)
            return view('jpanel.vendor.createVendor');
        else
            abort(403);
    }
    public function addVendor(Request $request)
    {
        $request->validate([
            'vendorName' => 'required',
            'password' => 'required',
            'username' => 'required|unique:users,username',
            'phone' => 'required|unique:users,phone',
            'email' => 'required|email|unique:users,email',
            'company_name' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'address1' => 'required',
            'zipcode' => 'required',
            'panNo' => 'required',

        ]);
        $user = new User;
        $user->name = $request->vendorName;
        $user->username = $request->username;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->status = '1';
        $user->save();
        $vendor = new VendorDetail;
        $vendor->user_id = $user->id;
        $vendor->company_name = $request->company_name;
        $vendor->country = $request->country;
        $vendor->state = $request->state;
        $vendor->city = $request->city;
        $vendor->address1 = $request->address1;
        $vendor->address2 = $request->address2;
        $vendor->zipcode = $request->zipcode;
        $vendor->panNo = $request->panNo;
        $vendor->gstNo = $request->gstNo;
        $vendor->websiteLink = $request->websiteLink;
        $vendor->save();
        if ($vendor) {
            return redirect('jpanel/vendors')->with('success', 'Vendor has been Add successfully!');
        } else {
            return redirect('jpanel/vendors')->with('error', 'Something went wrong. Try again.');
        }
    }

    public function editVendor($id)
    {
        $vendor = VendorDetail::find($id);
        $hasPermission = hasPermission('vendors', 3);
        if ($hasPermission)
            return view('jpanel.vendor.editVendor', ['vendor' => $vendor]);
        else
            abort(403);
    }

    public function updateVendor(Request $request, $id)
    {
        $request->validate([
            'vendorName' => 'required',
            'username' => 'required|unique:users,username,' .$request->user_id,
            'phone' => 'required|unique:users,phone,' .$request->user_id,
            'email' => 'required|email|unique:users,email,' .$request->user_id,
            'company_name' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'address1' => 'required',
            'zipcode' => 'required',
            'panNo' => 'required',
        ]);

        $user = User::where('id', $request->user_id)->update(['name' => $request->vendorName, 'username' => $request->username, 'phone' => $request->phone, 'email' => $request->email]);
        $vendor = VendorDetail::where('id', $id)->update([
            'company_name' => $request->company_name,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'address1' => $request->address1,
            'address2' => $request->address2,
            'zipcode' => $request->zipcode,
            'panNo' => $request->panNo,
            'gstNo' => $request->gstNo,
            'websiteLink' => $request->websiteLink
        ]);
        if ($vendor) {
            return redirect('jpanel/edit-vendor/'.$request->id)->with('success', 'Vendor has been updated!');
        } else {
            return redirect('jpanel/edit-vendor/'.$request->id)->with('error', 'Something went wrong. Try again.');
        }
    }

    public function viewVendor($id){
        $vendor = VendorDetail::find($id);
        $hasPermission = hasPermission('vendors',2);
        if($hasPermission)
            return view('jpanel.vendor.viewVendor', ['vendor'=>$vendor]);
        else
            abort(403);
    }

    public function vendorStatusChange(Request $request){
        $vendor = User::find($request->vendor_id);
        $vendor->status = $request->status;
        $vendor->save();
        return response()->json(['status'=>'success','message' => 'Status has been changed successfully!']);
    }

    public function vendorDelete(Request $request){
        User::find($request->vendor_id)->delete();
        return response()->json(['status'=>'success','message' => 'Vendor has been deleted successfully!']);
    }
}
