<?php

namespace App\Http\Controllers\Jpanel\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Module;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class ModuleController extends Controller
{
    //
    public function index(){
        $module=Module::all();
        $hasPermission = hasAnyOnePermission('modules');
        if($hasPermission)
            return view('jpanel.user.module',['modules'=>$module]);
        else
            abort(403);
    }

    public function addModule(Request $request){
        $request->validate([
            'pname' => 'required|unique:modules,name',
            'slug' => 'required|unique:modules,slug',
        ]);
        $module=new Module;
        $module->name=$request->pname;
        $module->slug=$request->slug;
        $module->save();
        if ($module) {
            return redirect('jpanel/module')->with('success', 'Module has been created successfully!');
        } else {
            return redirect('jpanel/module')->with('error', 'Something went wrong. Try again.');
        }
    }

    public function editModule($id){
        $module=Module::all();
        $emodule = Module::find($id);
        $hasPermission = hasPermission('modules',3);
        if($hasPermission)
            return view('jpanel.user.editModule', compact('emodule'),['modules'=>$module]);
        else
            abort(403);
    }

    public function updateModule (Request $request,$module_id){
        $request->validate([
            'pname' => 'required|unique:modules,name,'.$module_id,
            'slug' => 'required|unique:modules,slug,'.$module_id,
        ]);
        
        $module = Module::where('id', $module_id)->update(['name' => $request->pname, 'slug' => $request->slug]);
        if ($module) {
            return redirect('jpanel/module')->with('success', 'Module has been updated!');
        } else {
            return redirect('jpanel/module')->with('error', 'Something went wrong. Try again.');
        }
    }

    public function moduleDelete(Request $request)
    {
        Module::find($request->module_id)->delete();
        return response()->json(['status'=>'success','message' => 'Module has been Deleted successfully!']);
    }
}
