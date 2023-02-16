<?php

namespace App\Http\Controllers\Jpanel\branch;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\branch;

class BranchController extends Controller
{
    public function index()
    {
        $hasPermission = hasPermission('branch', 2);
        if ($hasPermission) {
            $branches = branch::all();
            return view('jpanel.branch.branchList'
            , compact('branches')
        );
        } 
        else {
            abort(404);
        }
    }

    public function create()
    {
        $hasPermission = hasPermission('branch', 1);
        if ($hasPermission) {
            return view('jpanel.branch.branchAdd', );
        } 
        else {
            abort(403);
        }
    }
    public function store(Request $request)
    {
        $request->validate([
            'bname' => 'required',
            'address' => 'required',
            'city' => 'required',
            'number' => 'numeric',
            'zipcode' => 'numeric',
        ]);
        $branch = new branch();
        $branch->name = $request->bname;
        $branch->address = $request->address;
        $branch->city = $request->city;
        $branch->number = $request->number;
        $branch->pincode = $request->zipcode;
        $branch->save();
        if ($branch) {
            return redirect('jpanel/branch/list')->with('success', 'Branch has been created successfully!');
        } else {
            return redirect('jpanel/branch/create')->with('error', 'Something went wrong. Try again.');
        }
    }


    public function delete(Request $request)
    {
        $branch = branch::where('id', $request->id)->get()->first();
        $branch->delete();

        return response()->json(['status' => 'success', 'message' => 'Branch has been deleted successfully!']);
    }

    public function edit($id)
    {
        $hasPermission = hasPermission('branch', 2);
        if ($hasPermission) {
            $branch = branch::where('id', $id)->get()->first();
            return view('jpanel.branch.branchEdit', compact('branch'));
        } else {
            abort(403);
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'bname' => 'required',
            'address' => 'required',
            'city' => 'required',
            'number' => 'numeric',
            'zipcode' => 'numeric',
        ]);

        $branch = branch::where('id', $request->id)->update(['name' => $request->bname,'address' => $request->address,'city' => $request->city, 'number'=>$request->number , 'pincode'=>$request->zipcode]);
        if ($branch) {
            return redirect('jpanel/branch/edit/' . $request->id)->with('success', 'Branch has been updated!');
        } else {
            return redirect('jpanel/branch/edit/' . $request->id)->with('error', 'Something went wrong. Try again.');
        }
    }
}
