<?php

namespace App\Http\Controllers\Jpanel\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use App\Models\Module;
use App\Models\Permission;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
class RoleController extends Controller
{
    //
    
    public function index(){
        $roles=Role::all();
        $hasPermission = hasAnyOnePermission('roles');
        if($hasPermission)
            return view('jpanel.user.role',['roles'=>$roles]);
        else
            abort(403);
    }

    public function addRole(Request $request){
        $request->validate([
            'rname' => 'required|unique:roles,name',
            'slug' => 'required|unique:roles,slug',
        ]);
        $role=new Role;
        $role->name=$request->rname;
        $role->slug=$request->slug;
        $role->save();
        if ($role) {
            return redirect('jpanel/role')->with('success', 'Role has been created successfully!');
        } else {
            return redirect('jpanel/role')->with('error', 'Something went wrong. Try again.');
        }
    }

    public function editRole($id){
        $role = Role::find($id);
        $modules=Module::all();
        $hasPermission = hasPermission('roles',3);
        if($hasPermission)
            return view('jpanel.user.editRole',['role'=>$role,'modules'=>$modules]);
        else
            abort(403);
    }

    public function updateRole (Request $request,$role_id){
        $request->validate([
            'rname' => 'required|unique:roles,name,'.$role_id,
            'slug' => 'required|unique:roles,slug,'.$role_id,
        ]);
        
        $user = Role::where('id', $role_id)->update(['name' => $request->rname, 'slug' => $request->slug]);
        if ($user) {
            return redirect('jpanel/role')->with('success', 'Role has been updated!');
        } else {
            return redirect('jpanel/role')->with('error', 'Something went wrong. Try again.');
        }
    }

    public function roleModule(Request $request){
        $role = Role::find($request->role_id);
        if($request->status=='1'){
            $role->modules()->attach($request->module_id);
            $userRoles= DB::table('user_role')->where('role_id', $request->role_id)->get();//get module list from role id from role_module table
            foreach ($userRoles as $userRole) {
                $user_id = $userRole->user_id;
                Permission::insert(['user_id' => $user_id,'module_id' => $request->module_id,'action_id' =>1]);//add  create permission in user_permission table
                Permission::insert(['user_id' => $user_id,'module_id' => $request->module_id,'action_id' =>2]);//add  read permission in user_permission table
                Permission::insert(['user_id' => $user_id,'module_id' => $request->module_id,'action_id' =>3]);//add  update permission in user_permission table
                Permission::insert(['user_id' => $user_id,'module_id' => $request->module_id,'action_id' =>4]);//add  delete permission in user_permission table
            }
        }else{
            $role->modules()->detach($request->module_id);
            $userRoles= DB::table('user_role')->where('role_id', $request->role_id)->get();//get module list from role id from role_module table
            foreach ($userRoles as $userRole) {
                $user_id = $userRole->user_id;
                Permission::where('user_id', $user_id)->where('module_id', $request->module_id)->delete(); // Delete all permission for role module
            }
        }
        return response()->json(['status'=>'success','message' => 'Status has been changed successfully!']);
    }

    public function roleDelete(Request $request)
    {
        Role::find($request->role_id)->delete();
        return response()->json(['status'=>'success','message' => 'Role has been Deleted successfully!']);
    }
}
