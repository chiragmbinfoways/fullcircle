<?php

namespace App\Http\Controllers\Jpanel\booking;

use App\Http\Controllers\Controller;
use App\Models\Services;
use App\Models\Employee;
use App\Models\EmployeeService;
use App\Models\EmployeeAvailability;
use App\Models\EmployeeCommission;
use App\Models\EmployeeBranch;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\CustomerPackage;
use App\Models\CustomerAppointment;
use App\Models\Package;
use Illuminate\Http\Request;
use App\Models\Branch;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function index()
    {
        $hasPermission = hasPermission('booking', 2);
        if ($hasPermission) {
            $bookings = Booking::orderBy('id', 'DESC')->get();
            return view('jpanel.booking.bookingList', compact('bookings'));
        } else {
            abort(404);
        }
    }

    public function create()
    {
        $hasPermission = hasPermission('booking', 1);
        if ($hasPermission) {
            $customers = Customer::all();
            $services = Services::all();
            $branches = Branch::all();
            return view('jpanel.booking.bookingAdd',['services'=>$services,'customers'=>$customers,'branches'=>$branches]);
        } else {
            abort(403);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer' => 'required',
            'package' => 'required',
            'emp' => 'required',
            'branch' => 'required',
            'date' => 'required',
            'day' => 'required',
            'stime' => 'required',
        ]);
        $book = new Booking();
        $book->customer_id = $request->customer ;
        $book->package_id = $request->package;
        $book->employee_id = $request->emp;
        $book->booking_date = $request->date;
        $book->day = $request->day;
        $book->branch = $request->branch;
        $book->stime = $request->stime;
        $timeinterval = $book->package->packages->services->time;
        $endtime =  Carbon::parse($request->stime)->addMinutes($timeinterval)->format('H:i');
        $book->etime =$endtime;
        $book->save();
        // customer package id
        $customer_appointments = CustomerAppointment::where('customerPack_id', $request->package)->where('appointment_taken', "0")->get()->first();
        if ($customer_appointments) {
        $customer_packageId = $customer_appointments->id;
        // customer appointment 
        $customer_appointments = CustomerAppointment::where('id', $customer_packageId)->update(['booking_id' => $book->id,'Appointment_date' => $request->date,'time' => $request->stime. "-".$endtime,'Trainer' => $request->emp,'appointment_taken' => "1"]);
        return redirect('jpanel/booking/list')->with('success', 'Booking has been done successfully!');
        }
        else {
            return redirect('jpanel/booking/create')->with('error', 'All Appointmets are done With this package!');
        }
    }
    public function workStatus(Request $request)
    {
        $booking = Booking::find($request->id);
        $booking->work_status = $request->status;
        $customerAppointment = CustomerAppointment::where('booking_id',$request->id)->first();
        $customerAppointment->visited = $request->status;
        $customerAppointment->save();
        $booking->save();
        // Employee Commission 
        if ($request->status == "1") {
            # code...
            $commission = new EmployeeCommission();
            $commission->appointment_id = $request->id;
            $employee = Booking::where('id',$request->id)->select('employee_id')->first();
            $commission->emp_id = $employee->employee_id;
            $commission_amt = Booking::where('id',$request->id)->select('package_id')->first();
            $commission_amt = $booking->package->packages->total;
            $commission->commission = $commission_amt ;
            $commission->save();
        }
        else{
            $commission = EmployeeCommission::where('appointment_id',$request->id)->first();
            $commission->delete();
        }
        return response()->json(['status' => 'success', 'message' => 'Training Status has been changed successfully!']);
    }

    public function delete(Request $request)
    {
        $booking = Booking::where('id', $request->id)->get()->first();
        $customerAppointment = CustomerAppointment::where('booking_id',$request->id)->first();
        $customerAppointment->booking_id = "-";
        $customerAppointment->Appointment_date = "-";
        $customerAppointment->time = "-";
        $customerAppointment->Trainer = "-";
        $customerAppointment->visited = "0";
        $customerAppointment->appointment_taken = "0";
        $customerAppointment->save();
        $booking->delete();
        return response()->json(['status' => 'success', 'message' => 'Booking has been deleted successfully!']);
    }

    // SERVICE AJAX DATA

    public function packageData(Request $request)
    {
        $id = $request->id;
        $packages = CustomerPackage::where('customer_id', $id)->get();
        foreach ($packages as  $package) {
           $package_available = CustomerAppointment::where('customerPack_id',$package->id)->where('appointment_taken', '0')->first();
           if ($package_available) {
            $packages_array[] = $package;
           }
        }
        return response()->json($packages_array);
    }
    public function employeeData(Request $request)
    {
        $packages = CustomerPackage::where('id',$request->id)->get()->first();
        $package = Package::where('id',$packages->package_id)->get()->first();
        $service_id =$package->service;
        $Service_time = Services::where('id',$service_id)->first();
        $Service_time = $Service_time->time;
        $branchEmployees = EmployeeBranch:: where('branch_id',$request->branch_id)->get();
        foreach ($branchEmployees as $branchEmployee ){
            $employees[] = EmployeeService::where('employee_id',$branchEmployee->employee_id)->where('service_id', $service_id)->first();
        }  
        $listofEmpName = [];
        $listofEmpId = [];
        if (!blank($employees)) {
            foreach ($employees as $employee) {
                if($employee != null){ 
                    $listofEmpName[] = $employee->employeeDetails->fname;
                    $listofEmpId[] = $employee->employeeDetails->id;
                }
            }
        }
        
        return response()->json(['listofEmpName'=>$listofEmpName, 'listofEmpId'=>$listofEmpId , 'Service_time'=>$Service_time]);
    }
    
    // customer data while change in branch
    public function customerData(Request $request)
    {
        $customer = Customer::all();
        return response()->json($customer);
    }

    // TASKS

    public function task()
    {
        $hasPermission = hasAnyOnePermission('appointments');
        if ($hasPermission) {
            $booking = Booking::orderBy('id', 'DESC')->get();
            // dd(Auth::user()->id);
        if (Auth::user()->status == 1) {
            if ($hasPermission) {
                return view('jpanel.booking.task', ['bookings' => $booking]);
            } else {
                abort(403);
            }
        } else {
            $user =Employee::where('user_id', Auth::id())->get()->first();
            $idOfEmployee = $user->id;
            $myItem = Booking::where('employee_id', $idOfEmployee)->orderBy('id', 'desc')->get();
            if ($hasPermission) {
                return view('jpanel.booking.task', ['bookings' => $myItem]);
            } else {
                abort(403);
            }
        }
    }
         else {
            abort(404);
        }
    }

}
