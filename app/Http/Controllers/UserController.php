<?php

namespace SPDP\Http\Controllers;

use SPDP\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function isUserAuthenticated()
    {
        if (Auth::check()) {
            return response()->json("true");
        } else {
            return response()->json('false');
        }
    }
    public function getUsers()
    {
        $role = auth()->user()->role;
        if ($role == 'pjk') {
            $users = User::with('fakulti:fakulti_id,kod,fakulti_id')->orderBy('created_at', 'desc')->paginate(10);
            return $users;
        } else {
            abort(404);
        }
    }

    public function getPanelPenilai()
    {
        $users = User::where('role', 'penilai')->orderBy('created_at', 'desc')->select('id', 'name', 'email', 'created_at')->paginate(10);
        return $users;
    }

    public function getUserInfo()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        return $user;
    }

    public function searchUsers($query)
    {
        if ($query) {
            $users = User::with('fakulti:fakulti_id,kod,fakulti_id')->where('name', 'like', '%' . $query . '%')
                ->orWhere('email', 'like', '%' . $query . '%')
                ->orWhere('role', 'like', '%' . $query . '%')
                ->get();
        }
        return $users;
    }

    public function searchPenilai($query)
    {
        if ($query) {
            $users = User::where('role', 'penilai')->where('name', 'like', '%' . $query . '%')
                ->orWhere('email', 'like', '%' . $query . '%')
                ->select('id', 'name', 'email', 'created_at')
                ->get();
        }
        return $users;
    }

    public function store(Request $request)
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

    public function edit($id = null)
    {
        if (!$id) {
            $user = auth()->user();
        } else {
            $user = User::findOrFail($id);
        }
        return $user;
    }

    public function update(Request $request, $id)
    {
        if ($request->input('role') == 'Fakulti') {
            $this->validate($request, [
                'name' => 'required|string|min:1',
                'email' => 'required|email|max:255|',
                'role' => 'required|string',
                'fakulti' => 'required'
            ]);
        } else {
            $this->validate($request, [
                'name' => 'required|string|min:1',
                'email' => 'required|email|max:255|',
                'role' => 'required|string',
            ]);
        }
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role =  strtolower($request->input('role'));
        if ($request->input('role') == 'Fakulti') {
            $user->fakulti_id = $request->input('fakulti');
        } else
            $user->fakulti_id = null;

        $user->save();
    }
}
