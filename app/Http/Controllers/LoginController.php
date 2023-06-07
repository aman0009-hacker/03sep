<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function postLogin(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return redirect()->back()->withErrors(['msg' => 'Credentials do not match'])->withInput($request->input());
        } else {
            Session::put('loginUserId', $user->id);
            Session::put('loginUserEmail', $user->email);
            //return redirect()->route('home')->withInput(Input:all());
            return redirect()->route('home')->withInput(['currentId' => $user->id, "data" => "success"]);

        }
    }

    public function postLogout(Request $request)
    {
        Session::flush();
        Auth::logout();
        response()->redirect('/login');
    }

    public function myaccount(Request $request)
    {
        //   dd("method  called");
        if (Auth::check()) {
            $checkCurrentUserId = Auth::user()->id;
            if (isset($checkCurrentUserId)) {
                $approvedStatus=User::where('id',$checkCurrentUserId)->first();
               if (isset($approvedStatus) && $approvedStatus->approved == 0) {
                    // dd("jkljl");
                    return redirect()->route('home');
                } else if (isset($approvedStatus) && $approvedStatus->approved == 1) {
                   return redirect()->route('PaymentDetails');
                } else if (isset($approvedStatus) && $approvedStatus->approved == 2) {
                   return redirect()->route('chat');
                }
            }

        }

    }
}