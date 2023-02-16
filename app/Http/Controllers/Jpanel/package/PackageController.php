<?php

namespace App\Http\Controllers\Jpanel\package;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\services;
use App\Models\branch;
use App\Models\package;

class PackageController extends Controller
{
    public function index()
    {
        $hasPermission = hasPermission('package', 2);
        if ($hasPermission) {
            $packages = package::all();
            return view('jpanel.package.packageList', compact('packages'));
        } 
        else {
            abort(404);
        }
    }

    public function create()
    {
        $hasPermission = hasPermission('package', 1);
        if ($hasPermission) {
            $services = services::all();
            $branches = branch::all();
            return view('jpanel.package.packageAdd', compact('services','branches') );
        } 
        else {
            abort(403);
        }
    }
    public function store(Request $request)
    {
        $request->validate([
            'pname' => 'required',
            'service' => 'required',
            'oDate' => 'required',
            'cDate' => 'required',
            'branch' => 'required',
            'time' => 'required|numeric',
            'total' => 'required|numeric',
        ]);
        $package = new package();
        $package->name = $request->pname;
        $package->service = $request->service;
        $package->times = $request->time;
        $package->oDate = $request->oDate;
        $package->cDate = $request->cDate;
        $package->branch = $request->branch;
        $package->total = $request->total;
        $package->save();
        if ($package) {
            return redirect('jpanel/package/list')->with('success', 'Package has been created successfully!');
        } else {
            return redirect('jpanel/package/create')->with('error', 'Something went wrong. Try again.');
        }
    }


    public function delete(Request $request)
    {
        $package = package::where('id', $request->id)->get()->first();
        $package->delete();

        return response()->json(['status' => 'success', 'message' => 'Package has been deleted successfully!']);
    }

    public function edit($id)
    {
        $hasPermission = hasPermission('package', 2);
        if ($hasPermission) {
            $services = services::all();
            $branches = branch::all();
            $package = package::where('id', $id)->get()->first();
            return view('jpanel.package.packageEdit', compact('package','services','branches'));
        } else {
            abort(403);
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'pname' => 'required',
            'service' => 'required',
            'branch' => 'required',
            'time' => 'required|numeric',
            'total' => 'required|numeric',
        ]);

        $package = package::where('id', $request->id)->update(['name' => $request->pname,'service' => $request->service,'times' => $request->time,'oDate' => $request->oDate,'cDate' => $request->cDate ,'branch' => $request->branch,'total'=>$request->total]);
        if ($package) {
            return redirect('jpanel/package/edit/' . $request->id)->with('success', 'Package has been updated!');
        } else {
            return redirect('jpanel/package/edit/' . $request->id)->with('error', 'Something went wrong. Try again.');
        }
    }
}
