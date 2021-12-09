<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function getLogin(Request $request){
        $email = $request->input('email');
        $password = $request->input('password');
        $remember = $request->input('remember')?true:false;
        if(Auth::attempt(['email' => $email, 'password' => $password],$remember)){
            if(User::where('email',$email)->first()->type == 'hospital'){
                return redirect('home');
            }
            
            if(User::where('email',$email)->first()->type == 'admin'){
                return redirect('dashboard/admin');
            }
            
        }else{
            return redirect('/')->with('wrong_account','Tài khoản hoặc mật khẩu bị sai!!');
        }
    }
}
