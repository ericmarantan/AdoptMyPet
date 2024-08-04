<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Validator;
use Hash;
use Session;

class UserController extends Controller
{
    public function dashboard() {
        Session::put('page', 'dashboard');
        return view("dashboard");
    }

    public function login(Request $request) {
        if ($request->isMethod("post")) {

            
            $data = $request->all();
            // //echo "<pre>"; print_r($data); die;

            $rules = [
                "email" => "required|email|max:255",
                "password" => "required|max:30",
            ];

            $customMessages = [
                "email.required" => "Email is required",
                "email.email" => "Valid email is required",
                "password.required" => "Password is required",
            ];

            $this->validate($request, $rules, $customMessages);


            if(Auth::guard('web')->attempt(['email'=>$data['email'],'password'=>$data['password']])) {
                return redirect("user/dashboard");

            } else {
                return redirect()->back()->with("error_message","Invalid Email or Password!");
            }
        }
        return view("user.login");
    }

}
