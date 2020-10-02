<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function auth(Request $request){
        $username = $request->username;
        $password = $request->password;
        $checking = User::where('username', $username)->first();
        if ($checking && Hash::check($password, $checking->password)) {
            Session::put('user_id', $checking->id);
            Session::put('name', $checking->name);
            Session::put('username', $checking->username);
            Session::put('level', $checking->level);
            Session::put('is_login', TRUE);
            return redirect()->route('dashboard');
        }else{
            return redirect()->back()
            ->with('alert', 'Username atau Password salah.')
            ->with('type', 'danger');
        }
    }

    public function destroy()
    {
        Session::flush();
        return redirect()->route('login')
            ->with('alert', 'Berhasil Keluar Akun.')
            ->with('type', 'success');
    }
}
