<?php

namespace App\Http\Controllers\Jpanel\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
class AuthController extends Controller
{
    //

    public function index(){
        if (Auth::check()) {
            return view('jpanel.dashboard');
        }else{
            return view('jpanel.auth.login');
        }
    }

    public function postLogin(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $remember_me  = ( !empty( $request->remember ) )? TRUE : FALSE;
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = User::where(["email" => $credentials['email']])->first();
            Auth::login($user, $remember_me);
            return redirect()->intended('jpanel/dashboard')
                        ->withSuccess('You have Successfully loggedin');
        }
        return redirect("jpanel/login")->with('error', 'Oppes! You have entered invalid credentials');
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect('jpanel/login');
    }
}
