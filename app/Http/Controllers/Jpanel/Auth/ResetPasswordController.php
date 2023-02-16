<?php

namespace App\Http\Controllers\Jpanel\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    //
    public function index($token)
    {
        if (Auth::check()) {
            return view('jpanel.dashboard');
        } else {
            return view('jpanel.auth.resetPassword',['token' => $token]);
        }
    }

    public function resetPasswordPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
        ]);
        $updatePassword = DB::table('password_resets')
            ->where(['email' => $request->email, 'token' => $request->token])
            ->first();
        if (!$updatePassword)
            return back()->withInput()->with('error', 'Invalid token!');
        $user = User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email' => $request->email])->delete();

        return redirect('jpanel/login')->with('success', 'Your password has been changed!');
    }
}
