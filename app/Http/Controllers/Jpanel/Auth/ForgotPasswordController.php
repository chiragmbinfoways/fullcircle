<?php

namespace App\Http\Controllers\Jpanel\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    //
    public function index(){
        if (Auth::check()) {
            return view('jpanel.dashboard');
        }else{
            return view('jpanel.auth.forgotPassword');
        }
    }

    public function forgotPasswordPost(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users'
        ]);
        $token = Str::random(60);
        
        DB::table('password_resets')->insert(
            ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
        );
        Mail::send('jpanel.auth.verify',['token' => $token], function($message) use ($request) {
            $message->from("jalpajacky@gmail.com");
            $message->to($request->email);
            $message->subject('Reset Password Notification');
         });
         return back()->with('message', 'We have e-mailed your password reset link!');
    }
}
