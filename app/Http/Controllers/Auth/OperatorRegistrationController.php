<?php

namespace SPDP\Http\Controllers\Auth;
use SPDP\Operator;
use SPDP\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Auth;


class OperatorRegistrationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    public function showRegistrationForm(){

        return view('auth.operator-registration');

    }

  public function register(Request $request)
    {

       //Validates data
        $this->validator($request->all())->validate();

       //Create operator
        $operator = $this->create($request->all());

        //Authenticates operator
        //$this->guard()->login($operator);

       //Redirects operator
        return redirect('/operator/login');
    }


   
     
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:operators',
            'license_number'=> 'required|string|max:23',
            'company_name' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    
    protected function create(array $data)
    {
        return Operator::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'license_number'=> $data['license_number'],
            'company_name' => $data['company_name'],
            'password' => Hash::make($data['password']),
        ]);
    }

    //Get the guard to authenticate Seller
   //protected function guard()
   //{
       //return Auth::guard('operator');
   //}

}
