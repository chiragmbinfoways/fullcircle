<?php

namespace App\Http\Controllers\Jpanel\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Branch;
use App\Models\Customer;
use App\Models\CustomerPackage;
use App\Models\CustomerAppointment;
use App\Models\EmployeeCommission;
use App\Models\Booking;


class CustomerController extends Controller
{
    public function index()
    {
        $hasPermission = hasPermission('customer', 2);
        if ($hasPermission) {
            $customers = Customer::all();
            return view('jpanel.customer.customerList', compact('customers'));
        } else {
            abort(404);
        }
    }

    public function create()
    {
        $hasPermission = hasPermission('services', 1);
        if ($hasPermission) {
             $last_customer = Customer::orderBy('customer_id', 'DESC')->first();
            if ($last_customer) {
                $last = $last_customer->customer_id + 1;
            } else {
                $last = '1001';
            }
            return view('jpanel.customer.customerAdd')->with(['last'=>$last]);
        } else {
            abort(403);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email',
            'number' => 'required|numeric',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'address1' => 'required',
            'address2' => 'required',
            'zipcode' => 'required',
            'gender' => 'required',
        ]);
        $customer = new Customer();
        $customer->customer_id = $request->cus_id;
        $customer->fname = $request->fname;
        $customer->lname = $request->lname;
        $customer->email = $request->email;
        $customer->phone = $request->number;
        $customer->country = $request->country;
        $customer->state = $request->state;
        $customer->city = $request->city;
        $customer->address1 = $request->address1;
        $customer->address2 = $request->address2;
        $customer->zipcode = $request->zipcode;
        $customer->gender = $request->gender;
        $customer->remarks = $request->remarks;

        $customer->save();
        if ($customer) {
            return redirect('jpanel/customer/list')->with('success', 'Customer has been created successfully!');
        } else {
            return redirect('jpanel/customer/create')->with('error', 'Something went wrong. Try again.');
        }
    }

    public function statusUpdate(Request $request)
    {
        $customer = Customer::find($request->id);
        $customer->status = $request->status;
        $customer->save();
        return response()->json(['status' => 'success', 'message' => 'Status has been changed successfully!']);
    }

    public function delete(Request $request)
    {
        $customer = Customer::where('id', $request->id)
            ->get()
            ->first();
        $customer->delete();

        return response()->json(['status' => 'success', 'message' => 'Customer has been deleted successfully!']);
    }

    public function edit($id)
    {
        $hasPermission = hasPermission('customer', 2);
        if ($hasPermission) {
            $customer = Customer::where('id', $id)
                ->get()
                ->first();
            return view('jpanel.customer.customerEdit', compact('customer'));
        } else {
            abort(403);
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'cus_id' => 'required',
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email',
            'number' => 'required|numeric',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'address1' => 'required',
            'address2' => 'required',
            'zipcode' => 'required',
            'gender' => 'required',
        ]);

        $custmor = Customer::where('id', $request->id)->update([
            'customer_id' => $request->cus_id,
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'phone' => $request->number,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'address1' => $request->address1,
            'address2' => $request->address2,
            'zipcode' => $request->zipcode,
            'gender' => $request->gender,
            'remarks' => $request->remarks,
        ]);
        if ($custmor) {
            return redirect('jpanel/customer/edit/' . $request->id)->with('success', 'Customer has been updated!');
        } else {
            return redirect('jpanel/customer/edit/' . $request->id)->with('error', 'Something went wrong. Try again.');
        }
    }
    public function packageSelector($id)
    {
        $hasPermission = hasPermission('customer', 2);
        if ($hasPermission) {
            $branches = Branch::all();
            $name = Customer::where('id', $id)->get()->first();
            $customerpackages = CustomerPackage::where('customer_id', $id)->orderBy('id','desc')->get();
            $allAppointments= [];
            if (!blank($customerpackages)) {
                foreach ($customerpackages as $key => $customerpackage) {
                    $appointments = CustomerAppointment::where('customerPack_id', $customerpackage->id)->get();
                    foreach($appointments as $Appointments){
                        $allAppointments[]=$Appointments;
                    }
                } 
            }
            return view('jpanel.customer.customerPackage', compact('name', 'customerpackages','allAppointments','branches'));
        } 
        else {
            abort(404);
        }
    }

    public function storePackage(Request $request, $id)
    {
        $request->validate([
            'package' => 'required',
        ]);
        $customer_package = new CustomerPackage();
        $customer_package->customer_id = $id;
        $customer_package->package_id = $request->package;
        $package_name = Package::where('id', $request->package)
            ->get()
            ->first();
        $customer_package->package_name = $package_name->name;
        $customer_package->save();
        for ($i = 0; $i < $package_name->times; $i++) {
            $defaultSlots = new CustomerAppointment();
            $defaultSlots->customerPack_id = $customer_package->id;
            $defaultSlots->Appointment_date = '-';
            $defaultSlots->time = '-';
            $defaultSlots->Trainer = '-';
            $defaultSlots->booking_id = '-';
            $defaultSlots->save();
        }
        if ($customer_package) {
            return redirect('jpanel/customer/package/' . $id)->with('success', 'Package has been created successfully!');
        } else {
            return redirect('jpanel/customer/package/' . $id)->with('error', 'Something went wrong. Try again.');
        }
    }
    public function customerStatusUpdate(Request $request)
    {
        $customerPackage = CustomerPackage::find($request->id);
        $customerPackage->payment_status = $request->status;
        $customerPackage->save();
        return response()->json(['status' => 'success', 'message' => 'Status has been changed successfully!']);
    }
    public function appointmentStatusUpdate(Request $request)
    {
        $customerPackage = CustomerAppointment::find($request->id);
        $customerPackage->visited = $request->status;
        $booking_id = $customerPackage->booking_id;
        $bookingWorkStatus = Booking::where('id',$customerPackage->booking_id)->first();
        $bookingWorkStatus->work_status = $request->status;
        $bookingWorkStatus->save();
        $customerPackage->save();
         // Employee Commission 
         if ($request->status == "1") {
            $commission = new EmployeeCommission();
            $commission->appointment_id = $booking_id;
            $employee = Booking::where('id',$booking_id)->select('employee_id')->first();
            $commission->emp_id = $employee->employee_id;
            $commission_amt = Booking::where('id',$booking_id)->select('package_id')->first();
            $commission_amt = $commission_amt->package->packages->total;
            $commission->commission = $commission_amt ;
            $commission->save();
        }
        else{
            $commission = EmployeeCommission::where('appointment_id',$booking_id)->first();
            $commission->delete();
        }
        return response()->json(['status' => 'success', 'message' => 'Status has been changed successfully!']);
    }
    public function extraPackage(Request $request,$id)
    {
        $extraAppointment = new CustomerAppointment();
        $extraAppointment->booking_id = '-';
        $extraAppointment->customerPack_id = $id;
        $extraAppointment->Appointment_date = '-';
        $extraAppointment->time = '-';
        $extraAppointment->Trainer = '-';
        $extraAppointment->save();
        return redirect()->back();
    }
    public function branchPackages(Request $request)
    {
        $packages = Package::where('branch',$request->id)->get();
        return response()->json($packages);
    }
}
