<?php

namespace SPDP\Http\Controllers;

use SPDP\User;
use Illuminate\Http\Request;
use SPDP\Fakulti;
use SPDP\Services\CreateUser;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function getUsers()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(10);
        return $users;
    }

    public function getRole()
    {
        $role = auth()->user()->role;
        return $role;
    }

    public function daftarPengguna(Request $request)
    {
        if ($request->input('role') == 'Fakulti') {
            $this->validate($request, [
                'name' => 'required|string|min:1',
                'email' => 'required|email|max:255|unique:users',
                'role' => 'required|string',
                'fakulti' => 'required'
            ]);
        } else {
            $this->validate($request, [
                'name' => 'required|string|min:1',
                'email' => 'required|email|max:255|unique:users',
                'role' => 'required|string',
            ]);
        }
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role =  strtolower($request->input('role'));
        if ($request->input('role') == 'Fakulti') {
            $user->fakulti_id = $request->input('fakulti');
        }
        $password = str_random(8);
        $user->password = Hash::make($password);
        $user->save();
    }

    public function editPengguna($id)
    {
        $user = User::find($id);
        return $user;
    }

    public function edit()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $fakultiSelected = auth()->user()->fakulti_id;

        $fakultis = Fakulti::all();
        return view('auth.settings')->with('user', $user)->with('fakultis', $fakultis)->with('selectedFakulti', $fakultiSelected);
    }

    public function update(Request $request, $id)
    {
        if ($request->input('role') == 'Fakulti') {
            $this->validate($request, [
                'name' => 'required|string|min:1',
                'email' => 'required|email|max:255|unique:users',
                'role' => 'required|string',
                'fakulti' => 'required'
            ]);
        } else {
            $this->validate($request, [
                'name' => 'required|string|min:1',
                'email' => 'required|email|max:255|unique:users',
                'role' => 'required|string',
            ]);
        }
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role =  strtolower($request->input('role'));
        if ($request->input('role') == 'Fakulti') {
            $user->fakulti_id = $request->input('fakulti');
        }
        $user->save();

        $msg = [
            'message' => 'Maklumat pengguna berjaya dikemaskini',
        ];
        return redirect('/settings')->with($msg);
    }
}
