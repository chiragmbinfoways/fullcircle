<?php

namespace App\Http\Controllers\Jpanel\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Module;
use App\Models\Permission;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    //
    public function index(){
        $users=User::all();
        $hasPermission = hasPermission('users',2);
        if($hasPermission)
            return view('jpanel.user.index',['users'=>$users]);
        else
            abort(403);
        
    }

    
    public function createUsers(Request $request){
        $hasPermission = hasPermission('users',1);
        if($hasPermission)
        return view('jpanel.user.createUser');
        else
            abort(403);
    }

    public function addUser(Request $request){
        $request->validate([
            'uname' => 'required',
            'username' => 'required|unique:users,username',
            'phone' => 'required|unique:users,phone',
            'email' => 'required|email|unique:users,email',
        ]);
        $user=new User;
        $user->name=$request->uname;
        $user->username=$request->username;
        $user->phone=$request->phone;
        $user->email=$request->email;
        $user->password= Hash::make('123456');
        $user->save();
        if ($user) {
            return redirect('jpanel/users')->with('success', 'User has been created successfully!');
        } else {
            return redirect('jpanel/users')->with('error', 'Something went wrong. Try again.');
        }
    }

    public function editUser($id){
        $user = User::find($id);
        $roles= Role::all();
        $hasPermission = hasPermission('users',3);
        if($hasPermission)
            return view('jpanel.user.editUser', ['user'=>$user,'roles'=>$roles]);
        else
            abort(403);
    }

    public function updateUser(Request $request,$user_id){
        $request->validate([
            'uname' => 'required',
            'username' => 'required|unique:users,username,'.$user_id,
            'phone' => 'required|unique:users,phone,'.$user_id,
            'email' => 'required|email|unique:users,email,'.$user_id,
        ]);
        
        $user = User::where('id', $user_id)->update(['name' => $request->uname, 'username' => $request->username, 'phone' => $request->phone, 'email' => $request->email]);
        if ($user) {
            return redirect('jpanel/users')->with('success', 'User has been updated!');
        } else {
            return redirect('jpanel/users')->with('error', 'Something went wrong. Try again.');
        }
    }
    
    public function viewUser($id){
        $user = User::find($id);
        $roles = $user->roles;
        $module = Module::all();
        $permissions= Permission::where('user_id', $id)->get();
        $hasPermission = hasPermission('users',2);
        if($hasPermission)
            return view('jpanel.user.viewUser', ['user'=>$user,'roles'=>$roles,'modules'=>$module,'permissions'=>$permissions]);
        else
            abort(403);
    }

    public function userRole(Request $request){
        $user = User::find($request->user_id);
        $roleModules= DB::table('role_module')->where('role_id', $request->role_id)->get();//get module list from role id from role_module table
        if($request->status=='1'){
            
            $user->roles()->attach($request->role_id); // role add in user_role table
            
            foreach ($roleModules as $roleModule) {
                $module = $roleModule->module_id;
                Permission::insert(['user_id' => $request->user_id,'module_id' => $module,'action_id' =>1]);//add  create permission in user_permission table
                Permission::insert(['user_id' => $request->user_id,'module_id' => $module,'action_id' =>2]);//add  read permission in user_permission table
                Permission::insert(['user_id' => $request->user_id,'module_id' => $module,'action_id' =>3]);//add  update permission in user_permission table
                Permission::insert(['user_id' => $request->user_id,'module_id' => $module,'action_id' =>4]);//add  delete permission in user_permission table
            }

        }else{
            $user->roles()->detach($request->role_id); // role delete in user_role table
            
            foreach ($roleModules as $roleModule) {
                $module = $roleModule->module_id;
                Permission::where('user_id', $request->user_id)->where('module_id', $module)->delete(); // Delete all permission for role module
            }
        }
        return response()->json(['status'=>'success','message' => 'Status has been changed successfully!']);
    }

    public function userStatusChange(Request $request){
        $user = User::find($request->user_id);
        $user->status = $request->status;
        $user->save();
        return response()->json(['status'=>'success','message' => 'Status has been changed successfully!']);
    }

    public function userDelete(Request $request){
        User::find($request->user_id)->delete();
        Permission::where('user_id', $request->user_id)->delete(); // Delete all permission of user
        return response()->json(['status'=>'success','message' => 'User has been deleted successfully!']);
    }


    public function userPermissions($id){
        $user = User::find($id);
        $module = Module::all();
        $permissions= Permission::where('user_id', $id)->get();//get module list from role id from role_module table
        return view('jpanel.user.userPermission', ['user'=>$user,'modules'=>$module,'permissions'=>$permissions]);
    }

    public function userPermissionsUpdate(Request $request){
        if($request->status=='1'){
                Permission::insert(['user_id' => $request->user_id,'module_id' => $request->module_id,'action_id' =>$request->action_id]);//add  create permission in user_permission table
        }else{
                Permission::where('user_id', $request->user_id)->where('module_id', $request->module_id)->where('action_id', $request->action_id)->delete(); // Delete all permission for role module
            }
        return response()->json(['status'=>'success','message' => 'Status has been changed successfully!']);
    }
}
