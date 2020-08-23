<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RegistrationModel;
use \Firebase\JWT\JWT;

class LoginController extends Controller
{
    function tokenTest(){
        return "token is ok";
    }

    function login(Request $request){
        $rules = [
            'email'=>'required|email',
            'password'=>'required'
        ];

        $this->validate($request,$rules);

        $email = $request->input('email');
        $password = $request->input('password');
        $countData = RegistrationModel::where(['email'=>$email,'password'=>$password])->count();
        if ($countData==1){
            $key = env('TOKEN_KEY');

            date_default_timezone_set("Asia/Dhaka");

            $payload = array(
                "iss" => "http://ahsanhabibnahid.com",
                "email" => $email,
                "iat" => time(),
                "exp" => time()+3600
            );

            $jwtEncode = JWT::encode($payload, $key);
            return  response()->json(['token'=>$jwtEncode,'status'=>'Login Success']);

        }
        else{
            return "login Fail";
        }
    }
}
