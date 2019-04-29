<?php

namespace SPDP\Http\Controllers;
use SPDP\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function edit()
    {   
        $user = auth()->user();
        return view('auth.settings')->with('user',$user);
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
                'fakulti'=>'required',
            ]);
            
            $user = auth()->user();
            $user = User::find($user->id);  
            $user->name = $request->get('name');
            $user->email = $request->get('email');
            $user->fakulti = $request->get('fakulti');
    
            
            $user->save();
            
            $msg = [
                'message' => 'Maklumat pengguna berjaya dikemaskini',
               ];


            return redirect('/settings')->with($msg);
            
            }catch (Exception $e) {
                return view('errors.1062');
            }

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
