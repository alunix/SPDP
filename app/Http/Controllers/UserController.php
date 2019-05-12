<?php

namespace SPDP\Http\Controllers;
use SPDP\User;
use Illuminate\Http\Request;
use SPDP\Fakulti;

class UserController extends Controller
{
    public function edit()
    {   
        $user_id = auth()->user()->id;
        $user= User::find($user_id);

        $fakultis= Fakulti::all();
        return view('auth.settings')->with('user',$user)->with('fakultis',$fakultis);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)    {      
        
        

        try{
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required',
               
            ]);
            
            
            $user = auth()->user();
            $role = $user->role;
            $user = User::find($user->id);  
            $user->name = $request->get('name');
            $user->email = $request->get('email');

            if($role=='fakulti')
            $user->fakulti_id = $request->get('fakulti');
            else
            
            $user->save();
            
            $msg = [
                'message' => 'Maklumat pengguna berjaya dikemaskini',
               ];


            return redirect('/settings')->with($msg);
            
            }catch (Exception $e) {
                return view('errors.1062');
            }

    }
    
    public function destroy($id)
    {
        //
    }
}
