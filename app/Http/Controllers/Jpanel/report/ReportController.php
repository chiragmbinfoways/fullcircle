<?php

namespace App\Http\Controllers\jpanel\report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Branch;
use App\Models\Employee;
use App\Models\Customer;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function branch()
    {
        $hasPermission = hasPermission('report', 2);
        if ($hasPermission) {
            $bookings = Booking::orderBy('id','DESC')->get();
            $branches = Branch::all();
            return view('jpanel.report.branchReport', compact('bookings','branches'));
        } 
        else {
            abort(404);
        }
    }

    public function branchFilter(Request $request)
    {
        $bookings = Booking::where('branch',$request->branch)->whereBetween('booking_date',[$request->sDate, $request->eDate])->get();
        $Appointments=[];
        foreach ($bookings as $booking ){
            $Appointments[]=[
                'id'=> $booking->id,
                'booking_date'=> Carbon::parse($booking->booking_date)->format('d-M-Y'),
                'customer_name'=> $booking->customer->fname.' '.$booking->customer->lname,
                'package_name'=>$booking->package->packages->name,
                'emp_name'=>$booking->employee->fname.''. $booking->employee->lname,
                'branch'=>$booking->branches->name,
                'time'=>$booking->stime .'-'.$booking->etime,
                'status'=>$booking->work_status,
            ]; 
        }
        return response()->json($Appointments);
    }

    public function trainer()
    {
        $hasPermission = hasPermission('report', 2);
        if ($hasPermission) {
            $bookings = Booking::orderBy('id','DESC')->get();
            $trainers = Employee::all();
            return view('jpanel.report.trainerReport', compact('bookings','trainers'));
        } 
        else {
            abort(404);
        }
    }

    public function trainerFilter(Request $request)
    {
        $bookings = Booking::where('employee_id',$request->trainer)->whereBetween('booking_date',[$request->sDate, $request->eDate])->get();
        $Appointments=[];
        foreach ($bookings as $booking ){
            $Appointments[]=[
                'id'=> $booking->id,
                'booking_date'=> Carbon::parse($booking->booking_date)->format('d-M-Y'),
                'customer_name'=> $booking->customer->fname.' '.$booking->customer->lname,
                'package_name'=>$booking->package->packages->name,
                'emp_name'=>$booking->employee->fname.''. $booking->employee->lname,
                'branch'=>$booking->branches->name,
                'time'=>$booking->stime .'-'.$booking->etime,
                'status'=>$booking->work_status,
            ]; 
        }
        return response()->json($Appointments);
    }

    public function customer()
    {
        $hasPermission = hasPermission('report', 2);
        if ($hasPermission) {
            $bookings = Booking::orderBy('id','DESC')->get();
            $customers = Customer::all();
            return view('jpanel.report.customerReport', compact('bookings','customers'));
        } 
        else {
            abort(404);
        }
    }
    public function customerFilter(Request $request)
    {
        $bookings = Booking::where('customer_id',$request->customer)->whereBetween('booking_date',[$request->sDate, $request->eDate])->get();
        $Appointments=[];
        foreach ($bookings as $booking ){
            $Appointments[]=[
                'id'=> $booking->id,
                'booking_date'=> Carbon::parse($booking->booking_date)->format('d-M-Y'),
                'customer_name'=> $booking->customer->fname.' '.$booking->customer->lname,
                'package_name'=>$booking->package->packages->name,
                'emp_name'=>$booking->employee->fname.''. $booking->employee->lname,
                'branch'=>$booking->branches->name,
                'time'=>$booking->stime .'-'.$booking->etime,
                'status'=>$booking->work_status,
            ]; 
        }
        return response()->json($Appointments);
    }


}
