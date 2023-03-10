<?php

namespace App\Http\Controllers\Jpanel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Module;
use App\Models\Language;
use App\Models\services;
use App\Models\booking;
use App\Models\customer;
use App\Models\package;
use App\Models\customerPackage;
use App\Models\EmployeeService;
use App\Models\EmployeeBranch;
use App\Models\branch;
use App\Models\Employee;
use App\Models\customerAppointment;
use Carbon\Carbon;
class DashboardController extends Controller
{
   
    public function index()
    {
        $bookings = booking::all();
        if (!blank($bookings)) {
            foreach ($bookings as $booking){
            $events[] = [
            'id'=> $booking->id,
            'title'=>$booking->customer->fname." ".$booking->customer->lname,
            'allDay'=> false,
            'start'=> $booking->booking_date."T".$booking->stime,
            'end'=>  $booking->booking_date."T".$booking->etime ,
            'backgroundColor'=> '#00a65a', //Success (green)
            'borderColor'=> '#00a65a', //Success (green)
            'textColor'=> 'white',
            'description'=> $booking->employee->fname.' '.$booking->employee->lname,
            'resourceId'=> $booking->employee_id,
            ];  

            $resources[]= [
            'id'=> $booking->employee_id,
            'title'=>$booking->employee->fname." ".$booking->employee->lname,
            ];
            }
        }
        else {
            $events = [];
            $resources= [];
        }
        $branch_name = "Select Branch";
        $customers = customer::all();
        $branches = branch::all();
        $employees = Employee::all();
        $employee_name = "Select Employee";
        return view('jpanel.dashboard',['bookings'=> $events,'resources'=>$resources, 'customers'=>$customers,'branches'=>$branches,'branch_name'=>$branch_name,'employee_name'=>$employee_name,'employees'=>$employees]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'emp' => 'required',
            'package' => 'required',
            'customer' => 'required',
            'branch' => 'required',

        ]);
        $book = new booking();
        $book->customer_id = $request->customer ;
        $book->package_id = $request->package;
        $book->employee_id = $request->emp;
        $book->booking_date = $request->bookingDate;
        $book->day = $request->dayName;
        $book->branch = $request->branch;
        $book->stime = $request->stime;
        $timeinterval = $book->package->packages->services->time;
        $endtime =  Carbon::parse($request->stime)->addMinutes($timeinterval)->format('H:i');
        $book->etime =$endtime;
         // customer package id
         $customer_appointments = customerAppointment::where('customerPack_id', $request->package)->where('appointment_taken', "0")->get()->first();
        if ($customer_appointments) {
        $customer_packageId = $customer_appointments->id;
        $book->save();
        // customer appointment 
        $customer_appointments = customerAppointment::where('id', $customer_packageId)->update(['Appointment_date' => $request->bookingDate,'booking_id' => $book->id,'time' => $request->stime. "-".$endtime,'Trainer' => $request->emp,'appointment_taken' => "1"]);
        return response()->json(['success' => 'true']);
    }
    else{
        return response()->json(['success' => 'false']);
        
    }
}
    public function adminSettings()
    {
        $totalModule = Module::all()->count();
        $totalRole = Role::all()->count();
        $totalUser = User::all()->count();
        $totalLanguage = Language::all()->count();
        return view('jpanel.adminSettings',['totalModule'=>$totalModule,'totalLanguage'=>$totalLanguage,'totalRole'=>$totalRole,'totalUser'=>$totalUser]);
    }

    // AJAX FUNCTIONS 
    public function packageData(Request $request)
    {
        $id = $request->id;
        $packages = customerPackage::where('customer_id', $id)->get();
        foreach ($packages as  $package) {
           $package_available = customerAppointment::where('customerPack_id',$package->id)->where('appointment_taken', '0')->first();
           if ($package_available) {
            $packages_array[] = $package;
           }
        }
        return response()->json($packages_array);
    }
    // Employee Data
    public function employeeData(Request $request)
    {
        $packages = customerPackage::where('id',$request->id)->get()->first();
        $package = package::where('id',$packages->package_id)->get()->first();
        $service_id =$package->service;
        $Service_time = services::where('id',$service_id)->first();
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

    public function edit($id)
    {
        $booking = booking::where('id',$id)->get()->first();
        $branches = branch::all();
        $packages = customerPackage::where('customer_id', $booking->customer_id)->get();
        foreach ($packages as  $package) {
           $package_available = customerAppointment::where('customerPack_id',$package->id)->where('appointment_taken', '0')->first();
           if ($package_available) {
            $packages_array[] = $package;
           }
        }
        // Employees for services 
        $packages = customerPackage::where('id',$booking->package_id)->get()->first();
        $package = package::where('id',$packages->package_id)->get()->first();
        $service_id =$package->service;
        $Service_time = services::where('id',$service_id)->first();
        $Service_time = $Service_time->time;
        $employees = EmployeeService::where('service_id', $service_id)->get();
        return view('jpanel.booking.bookingEdit',['booking'=>$booking,'packages'=>$packages_array,'service_time'=>$Service_time,'employees'=>$employees,'branches'=>$branches]);
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'customer' => 'required',
            'package' => 'required',
            'emp' => 'required',
            'date' => 'required',
            'day' => 'required',
            'stime' => 'required',
        ]);
            $endtime =  Carbon::parse($request->stime)->addMinutes($request->time)->format('H:i');
            $bookingUpdate = booking::where('id', $id)
            ->update(['customer_id' => $request->customer,
                    'package_id' => $request->package,
                    'employee_id' => $request->emp,
                    'booking_date' => $request->date,
                    'day' => $request->day,
                    'stime' => $request->stime,
                    'etime' => $endtime]); 
            $customerAppointmentUpdate = customerAppointment::where('booking_id', $id)
            ->update(['customerPack_id' => $request->package,
                    'Appointment_date' => $request->date,
                    'time' => $request->stime ."-". $endtime ,
                    'Trainer' => $request->emp]); 
            return redirect('/jpanel/dashboard/booking/edit/' .$id)->with('success', 'Appointment has been updated!');
        
    }

    public function dragUpdate(Request $request)
    {
        $day = Carbon::parse($request->date)->format('l');
        if($request->employee_id == null){
        $bookingUpdate = booking::where('id', $request->id)->update(['booking_date' => $request->date,'day'=>$day, 'stime'=>$request->startTime,'etime'=>$request->endTime]); 
        $customerAppointmentUpdate = customerAppointment::where('booking_id', $request->id)->update(['Appointment_date' => $request->date, 'time'=> $request->startTime."-".$request->endTime]); 
        return response()->json(['status' => 'success', 'message' => 'Status has been changed successfully!']);
        }
        $bookingUpdate = booking::where('id', $request->id)->update(['booking_date' => $request->date,'day'=>$day, 'stime'=>$request->startTime,'etime'=>$request->endTime,'employee_id'=>$request->employee_id]); 
        $customerAppointmentUpdate = customerAppointment::where('booking_id', $request->id)->update(['Appointment_date' => $request->date, 'time'=> $request->startTime."-".$request->endTime, 'Trainer'=>$request->employee_id]); 
        return response()->json(['status' => 'success', 'message' => 'Status has been changed successfully!']);
    }

    // DELETE BOOKING FUNCTION 

    public function delete(Request $request)
    {
        $booking = booking::where('id', $request->id)->get()->first();
        $customerAppointment = customerAppointment::where('booking_id',$request->id)->first();
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

    // Branch Filter for calender
    public function branchFilter(Request $request )
    {
        $bookings = booking::where('branch', $request->branchFilter)->get();
        if (!blank($bookings)) {
            foreach ($bookings as $booking){
                $events[] = [
                'id'=> $booking->id,
                'title'=>$booking->customer->fname." ".$booking->customer->lname,
                'allDay'=> false,
                'start'=> $booking->booking_date."T".$booking->stime,
                'end'=>  $booking->booking_date."T".$booking->etime ,
                'backgroundColor'=> '#00a65a', //Success (green)
                'borderColor'=> '#00a65a', //Success (green)
                'textColor'=> 'white',
                'description'=> $booking->employee->fname.' '.$booking->employee->lname,
                'resourceId'=> $booking->employee_id
                ];  

                $resources[]= [
                'id'=> $booking->employee_id,
                'title'=>$booking->employee->fname." ".$booking->employee->lname,
                ];
            }
        }
        else{
            $events=[];
            $resources =[];
        }
        $branch_name = branch::where('id',$request->branchFilter)->first();
        $branch_name = $branch_name->name;
        $customers = customer::all();
        $branches = branch::all();
        $employees = Employee::all();
        $employee_name = "Select Employee";
        return view('jpanel.dashboard',['bookings'=> $events,'resources'=>$resources, 'customers'=>$customers,'branches'=>$branches,'branch_name'=>$branch_name, 'employee_name'=>$employee_name,'employees'=>$employees]);
    }
    // Employee Filter for calender
    public function employeeFilter(Request $request )
    {
        if ($request->employeeFilter== "All") {
        $bookings = booking::all();
        }
        else{
        $bookings = booking::where('employee_id', $request->employeeFilter)->get();
        }
        if (!blank($bookings)) {
            foreach ($bookings as $booking){
                $events[] = [
                'id'=> $booking->id,
                'title'=>$booking->customer->fname." ".$booking->customer->lname,
                'allDay'=> false,
                'start'=> $booking->booking_date."T".$booking->stime,
                'end'=>  $booking->booking_date."T".$booking->etime ,
                'backgroundColor'=> '#00a65a', //Success (green)
                'borderColor'=> '#00a65a', //Success (green)
                'textColor'=> 'white',
                'description'=> $booking->employee->fname.' '.$booking->employee->lname,
                'resourceId'=> $booking->employee_id
                ];  

                $resources[]= [
                'id'=> $booking->employee_id,
                'title'=>$booking->employee->fname." ".$booking->employee->lname,
                ];
            }
        }
        else{
            $events =[];
            $resources =[];
        }
        if ($request->employeeFilter== "All") {
        $employee_name ="All";
        }
        else{
        $employee_name = Employee::where('id',$request->employeeFilter)->first();
        $employee_name = $employee_name->fname." ".$employee_name->lname;
        }
        $customers = customer::all();
        $branches = branch::all();
        $employees = Employee::all();
        $branch_name = "Select Branch";
        return view('jpanel.dashboard',['bookings'=> $events,'resources'=>$resources, 'customers'=>$customers,'branches'=>$branches,'branch_name'=>$branch_name, 'employee_name'=>$employee_name,'employees'=>$employees]);
    }
    
}

