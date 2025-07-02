<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SysUserController extends Controller
{
    public function register() {
        return view('users.register');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required|unique:users,name',
            'password' => 'required|min:7',
            'password2' => 'required|confirmed:password',
        ]);

        $data['password'] = bcrypt($data['password']);
        
        User::create([
            'name' => $data['name'],
            'password' => $data['password']
        ]);

        return redirect()->route('login');
    }

    public function login() {
        return view('users.login');
    }

    public function authenticate(Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt(['name' => $data['name'], 'password' => $data['password']])) {
            $request->session()->regenerate();

            return redirect()->intended(route('authors.index'));
        }

        return redirect()->back()->witherrors(['name' => 'username not found!'])->onlyInput('name');
    }

    public function logout() {
        Auth::logout();

        return redirect()->route('login');
    }
}
