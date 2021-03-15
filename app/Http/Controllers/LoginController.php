<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class LoginController extends Controller
{
    //
    public function index(){
        return view('login');
    }

    public function checkLogin(Request $request){
        $email = $request->input('email');
        $password = $request->input('password');

        if(Auth::guard('web')->attempt(["email"=>$email, "password"=>$password])){
            return response()->json(['success'=>true],200);
        }else{
            return response()->json(['success'=>false, 'message'=>'login gagal!'], 401);
        }
    }

}
