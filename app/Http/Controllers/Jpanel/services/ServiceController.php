<?php

namespace App\Http\Controllers\Jpanel\services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Services;

class ServiceController extends Controller
{
    public function index()
    {
        $hasPermission = hasPermission('services', 2);
        if ($hasPermission) {
            $services = Services::all();
            return view('jpanel.services.serviceList'
            , compact('services')
        );
        } 
        else {
            abort(404);
        }
    }

    public function create()
    {
        $hasPermission = hasPermission('services', 1);
        if ($hasPermission) {
            return view('jpanel.services.serviceAdd', );
        } 
        else {
            abort(403);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'time' => 'required|numeric',
            // 'gst' => 'required',
        ]);
        $services = new Services();
        $services->name = $request->name;
        $services->price = $request->price;
        $services->gst = $request->gst;
        $services->time = $request->time;
        $services->save();
        if ($services) {
            return redirect('jpanel/service/create')->with('success', 'Service has been created successfully!');
        } else {
            return redirect('jpanel/service/create')->with('error', 'Something went wrong. Try again.');
        }
    }

    public function statusUpdate(Request $request)
    {
        $service = Services::find($request->id);
        $service->status = $request->status;
        $service->save();
        return response()->json(['status' => 'success', 'message' => 'Status has been changed successfully!']);
    }

    public function delete(Request $request)
    {
        $service = Services::where('id', $request->id)->get()->first();
        $service->delete();

        return response()->json(['status' => 'success', 'message' => 'Service has been deleted successfully!']);
    }

    public function edit($id)
    {
        $hasPermission = hasPermission('services', 2);
        if ($hasPermission) {
            $service = Services::where('id', $id)->get()->first();
            return view('jpanel.services.serviceEdit', compact('service'));
        } else {
            abort(403);
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'time' => 'required|numeric',
            // 'gst' => 'required',
        ]);

        $service = Services::where('id', $request->id)->update(['name' => $request->name,'price' => $request->price,'gst' => $request->gst, 'time'=>$request->time]);
        if ($service) {
            return redirect('jpanel/service/edit/' . $request->id)->with('success', 'Service has been updated!');
        } else {
            return redirect('jpanel/service/edit/' . $request->id)->with('error', 'Something went wrong. Try again.');
        }
    }
}
