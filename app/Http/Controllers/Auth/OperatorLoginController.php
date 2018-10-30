<?php

namespace SPDP\Http\Controllers\Auth;

use Illuminate\Http\Request;
use SPDP\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use SPDP\Operator;

class OperatorLoginController extends Controller
{
    //

    public function __construct(){


        $this -> middleware('guest:operator');

    }

    public function showLoginForm(){

        return view('auth.operator-login');

    }

    public function login(Request $request){
        //validate form data

        $this -> validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        // attempt to log user in
        
       if (Auth::guard('operator')->attempt(['email'=>$request->email,'password'=>$request->password],$request ->remember)){

         //Redirect to inteded pages if success ful

         return redirect()-> intended(route('operator.dashboard'));

       }
        // Redirect back to login page if unsuccessful.

        return redirect()->back()-> withInput($request->only('email','remember'));

    }

}
