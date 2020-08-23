<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PhoneBookModel;
use \Firebase\JWT\JWT;

class DetailsControlller extends Controller
{
    function insert(Request $request){

        $rules=[
            "access_token"=>"required",
            "name"=>"required",
            "username"=>"required",
            "phn_number_one"=>"required|min:11|max:11",
            "phn_number_two"=>"required|min:11|max:11",
            "phn_number_three"=>"required|min:11|max:11",
            "phn_number_four"=>"required|min:11|max:11",
            "phn_number_five"=>"required|min:11|max:11",
            "address"=>"required|max:255"
        ];
        $this->validate($request,$rules);

        $token = $request->input('access_token');
        $key = env('TOKEN_KEY');
        $decodeString = JWT::decode($token,$key,array('HS256'));
        $decodeArray = (array)$decodeString;
        $decodeEmail = $decodeArray['email'];

        $name = $request->input('name');
        $username = $request->input('username');
        $phn_number_one = $request->input('phn_number_one');
        $phn_number_two = $request->input('phn_number_two');
        $phn_number_three = $request->input('phn_number_three');
        $phn_number_four = $request->input('phn_number_four');
        $phn_number_five = $request->input('phn_number_five');
        $address = $request->input('address');



        $result = PhoneBookModel::insert([
            'name'=>$name,
            'username'=>$username,
            'phn_number_one'=>$phn_number_one,
            'phn_number_two'=>$phn_number_two,
            'phn_number_three'=>$phn_number_three,
            'phn_number_four'=>$phn_number_four,
            'phn_number_five'=>$phn_number_five,
            'email'=>$decodeEmail,
            'address'=>$address,
        ]);

        if ($result==true){
            return 'Data Insert Success';
        }
        else{
            return 'Data Insert Fail!';
        }
    }

    function select(Request $request){
        $rules = ["access_token"=>"required"];
        $this->validate($request,$rules);

        $token = $request->input('access_token');
        $key = env('TOKEN_KEY');
        $decodeString = JWT::decode($token,$key,array('HS256'));
        $decodeArray = (array)$decodeString;
        $decodeEmail = $decodeArray['email'];

        $result = PhoneBookModel::where('email',$decodeEmail)->get();

        return response()->json($result);
    }


    function delete(Request $request){
        $rules = [
            "access_token"=>"required"
        ];
        $this->validate($request,$rules);

        $token=$request->input('access_token');
        $key=env('TOKEN_KEY');
        $decoded = JWT::decode($token, $key, array('HS256'));
        $decoded_array=(array)$decoded ;
        $email=$decoded_array['email'];

        $result=PhoneBookModel::where(['email'=> $email])->delete();


        if($result==true){
            return "Delete Success";
        }
        else{

            return "Delete Fail! Try Again";
        }

    }
}
