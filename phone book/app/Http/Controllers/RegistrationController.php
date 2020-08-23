<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RegistrationModel;

class RegistrationController extends Controller
{
    function register(Request $request){

        $rules = [
            'firstname'=>'required',
            'lastname'=>'required',
            'username'=>'required',
            'email'=>'required|email',
            'phone'=>'required|min:11|max:11',
            'gender'=>'required',
            'address'=>'required',
            'password'=>'required'
        ];
        $this->validate($request,$rules);

        $firstname = $request->input("firstname");
        $lastname = $request->input("lastname");
        $username = $request->input("username");
        $email = $request->input("email");
        $phone = $request->input("phone");
        $gender = $request->input("gender");
        $address = $request->input("address");
        $password = $request->input("password");

        $countData = RegistrationModel::where('email',$email)->count();

        if ($countData!=0){
            return "User Already Exists!";
        }
        else{
            $result = RegistrationModel::insert([
                'firstname'=>$firstname,
                'lastname'=>$lastname,
                'username'=>$username,
                'email'=>$email,
                'phone'=>$phone,
                'gender'=>$gender,
                'address'=>$address,
                'password'=>$password,
            ]);
            if ($result==true){
                return "Insert Success!";
            }
            else{
                return "Insert Fail, Try Again!";
            }
        }




    }
}
