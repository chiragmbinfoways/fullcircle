<?php

namespace App\Http\Controllers\Jpanel\employee;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Services;
use App\Models\User;
use App\Models\Employee;
use App\Models\Branch;
use App\Models\EmployeeService;
use App\Models\EmployeeAvailability;
use App\Models\EmployeeCommission;
use App\Models\EmployeeBranch;
use Carbon\Carbon;


class EmployeeController extends Controller
{
    public function index()
    {
        $hasPermission = hasPermission('employees', 2);
        if ($hasPermission) {
            $employees = Employee::orderBy('id','DESC')->get();
            $branches = EmployeeBranch::all();
            return view('jpanel.employee.employeeList'
            , compact('employees','branches')
        );
        } 
        else {
            abort(404);
        }
    }

    public function create()
    {
        $hasPermission = hasPermission('employees', 1);
        if ($hasPermission) {
            $branches = Branch::all();
            $services = Services::all();
            return view('jpanel.employee.employeeAdd',
             compact('services','branches')
            );
        } 
        else {
            abort(403);
        }
    }

    public function store(Request $request)
    {
        $service_lists = $request->service;
        $branch_lists = $request->branch;
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email|unique:users,email',
            'number' => 'required|numeric|unique:users,phone',
            'gender' => 'required',
            'commission' => 'required|numeric',
            'branch' => 'required',
            'service' => 'required',
        ]);
        $user = new User();
        $user->name = $request->fname." ".$request->lname ;
        $user->email = $request->email;
        $user->username = $request->email;
        $user->phone = $request->number;
        $user->password = Hash::make('123456'); 
        $user->status ="0" ;
        $user->save();

        $employee = new Employee();
        $employee->user_id = $user->id ;
        $employee->fname = $request->fname ;
        $employee->lname = $request->lname ;
        $employee->dob = $request->dob ;
        $employee->email = $request->email ;
        $employee->phone = $request->number ;
        $employee->commission = $request->commission;
        $employee->gender = $request->gender ;
        $employee->status = "1" ;
        $employee->save();


    foreach($service_lists as $service_list) {
        $service = new EmployeeService();
        $service->employee_id = $employee->id;
        $service->service_id = $service_list;
        $service->save();
    }
    foreach($branch_lists as $branch_list) {
        $branch = new EmployeeBranch();
        $branch->employee_id = $employee->id;
        $branch->branch_id = $branch_list;
        $branch->save();
    }
        if ($branch) {
            return redirect('jpanel/employee/list')->with('success', 'Employee has been created successfully!');
        } else {
            return redirect('jpanel/employee/create')->with('error', 'Something went wrong. Try again.');
        }
    }

    public function statusUpdate(Request $request)
    {
        $employee = Employee::find($request->id);
        $employee->status = $request->status;
        $employee->save();
        return response()->json(['status' => 'success', 'message' => 'Status has been changed successfully!']);
    }

    public function delete(Request $request)
    {
        $employee = Employee::where('id', $request->id)->get()->first();
        $employee->delete();
        return response()->json(['status' => 'success', 'message' => 'Employee has been deleted successfully!']);
    }

    public function edit($id)
    {
        $hasPermission = hasPermission('employees', 2);
        if ($hasPermission) {
            $employee = Employee::where('id', $id)->get()->first();
            $services = EmployeeService::where('employee_id',$id)->get();
            $branches = EmployeeBranch::where('employee_id',$id)->get();
            return view('jpanel.employee.employeeEdit', compact('employee','services','branches'));
        } else {
            abort(403);
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email',
            'number' => 'required|numeric',
            'commission' => 'required|numeric',
            'branch' => 'required',
            'gender' => 'required',
        ]);

        $employee = Employee::where('id', $request->id)->update(['fname' => $request->fname,'lname' => $request->lname,'dob' => $request->dob, 'email'=>$request->email, 'phone'=>$request->number, 'gender'=>$request->gender, 'commission'=>$request->commission , 'branch'=>$request->branch]);
        if ($employee) {
            return redirect('jpanel/employee/edit/' . $request->id)->with('success', 'Employee has been updated!');
        } else {
            return redirect('jpanel/employee/edit/' . $request->id)->with('error', 'Something went wrong. Try again.');
        }
    }

    public function availability($id)
    {
        $emp_id = $id;
        $hasPermission = hasPermission('employees', 2);
        if ($hasPermission) {
            $days = EmployeeAvailability::where('employee_id',$id)->get();
            return view('jpanel.employee.employeeAvailability', compact('emp_id','days'));
        } else {
            abort(403);
        }
    }

    public function storeAvailability(Request $request,$id)
    {
        $request->validate([
            'day' => 'required',
            'time' => 'required'
        ]);

        $employee = new EmployeeAvailability();
        $employee->employee_id = $id;
        $employee->day = $request->day;
        $employee->time = $request->time;
        $employee->save();
        if ($employee) {
            return redirect()->back()->with('success', 'Availability has been added successfully!');
        } else {
            return redirect()->back()->with('error', 'Something went wrong. Try again.');
        }
    }

    public function deleteAvl(Request $request)
    {
        $employee = EmployeeAvailability::where('id', $request->id)->get()->first();
        $employee->delete();
        return response()->json(['status' => 'success', 'message' => 'Avalability has been deleted successfully!']);
    }
    public function commission($id)
    {
        $hasPermission = hasPermission('employees', 2);
        if ($hasPermission) {
            $commissions = EmployeeCommission::where('emp_id',$id)->get();
            $recivableAmt = EmployeeCommission::where('emp_id',$id)->where('payment_status',"0")->sum('commission');
            return view('jpanel.employee.employeeCommission', compact('commissions','recivableAmt'));
        } else {
            abort(403);
        }
    }

    
    public function commissionStatus(Request $request)
    {
        $employee = EmployeeCommission::find($request->id);
        $employee->payment_status = $request->status;
        $employee->save();
        return response()->json(['status' => 'success', 'message' => ' Payment Status has been changed successfully!']);
    }

}
