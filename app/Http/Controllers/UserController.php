<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        $data = [
            'p_name' => 'user',
            'users' => $user,
        ];
        return view('user.index', $data);
    }

    public function create()
    {
        $data = [
            'p_name' => 'user',
        ];
        return view('user.create', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_pengguna' => 'required',
            'nama_lengkap' => 'required',
            'kata_sandi' => 'required',
            'level' => Rule::notIn('NULL'),
        ]);

        $data = new User();
        $data->name = $request->nama_lengkap;
        $data->username = $request->nama_pengguna;
        $data->password = Hash::make($request->kata_sandi);
        $data->level = $request->level;

        if ($data->save()) {
            return redirect()->route('user.index')
                ->with('alert', "Berhasil menambahkan pengguna.")
                ->with('type', 'success');
        }else{
            return redirect()->back()
                ->with('alert', "Terjadi Kesalahan pada sistem, coba lagi nanti.")
                ->with('type', 'danger');
        }
    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {
        $data = [
            'p_name' => 'user',
            'user' => $user,
        ];
        return view('user.edit', $data);
    }

    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'nama_pengguna' => 'required',
            'nama_lengkap' => 'required',
            'level' => Rule::notIn('NULL'),
        ]);
        
        $update = [
            'name' => $request->nama_lengkap,
            'username' => $request->nama_pengguna,
            'level' => $request->level
        ];

        if ($request->kata_sandi != NULL) {
            $update['password'] = Hash::make($request->kata_sandi);
        }

        if ($user->update($update)) {
            return redirect()->route('user.index')
                ->with('alert', "Berhasil mengubah pengguna.")
                ->with('type', 'success');
        }else{
            return redirect()->back()
                ->with('alert', "Terjadi Kesalahan pada sistem, coba lagi nanti.")
                ->with('type', 'danger');
        }
        
    }

    public function destroy(User $user)
    {
        if ($user->delete()) {
            return redirect()->route('user.index')
                ->with('alert', "Berhasil menghapus pengguna.")
                ->with('type', 'success');
        }else{
            return redirect()->back()
                ->with('alert', "Terjadi Kesalahan pada sistem, coba lagi nanti.")
                ->with('type', 'danger');
        }
    }
}
