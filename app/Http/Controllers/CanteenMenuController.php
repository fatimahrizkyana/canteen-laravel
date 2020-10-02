<?php

namespace App\Http\Controllers;

use App\Models\CanteenMenu;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CanteenMenuController extends Controller
{
    public function index()
    {
        $menu = CanteenMenu::all();
        $data = [
            'p_name' => 'menu',
            'menus' => $menu
        ];
        return view('menu.index', $data);
    }

    public function create()
    {
        $data = [
            'p_name' => 'menu',
        ];
        return view('menu.create', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'harga' => 'required',
            'tersedia' => Rule::notIn('NULL'),
        ]);

        $data = new CanteenMenu();
        $data->name = $request->nama;
        $data->price = $request->harga;
        $data->status = $request->tersedia;

        if ($data->save()) {
            return redirect()->route('canteen-menu.index')
                ->with('alert', "Berhasil menambahkan menu kantin.")
                ->with('type', 'success');
        }else{
            return redirect()->back()
                ->with('alert', "Terjadi Kesalahan pada sistem, coba lagi nanti.")
                ->with('type', 'danger');
        }
    }

    public function show(CanteenMenu $canteenMenu)
    {
        //
    }

    public function edit(CanteenMenu $canteenMenu)
    {
        $data = [
            'p_name' => 'menu',
            'menu' => $canteenMenu,
        ];
        return view('menu.edit', $data);
    }

    public function update(Request $request, CanteenMenu $canteenMenu)
    {
        $this->validate($request, [
            'nama' => 'required',
            'harga' => 'required',
            'tersedia' => Rule::notIn('NULL'),
        ]);

        $update = [
            'name' => $request->nama,
            'price' => $request->harga,
            'status' => $request->tersedia
        ];

        if ($canteenMenu->update($update)) {
            return redirect()->route('canteen-menu.index')
                ->with('alert', "Berhasil mengubah menu kantin.")
                ->with('type', 'success');
        }else{
            return redirect()->back()
                ->with('alert', "Terjadi Kesalahan pada sistem, coba lagi nanti.")
                ->with('type', 'danger');
        }
    }

    public function destroy(CanteenMenu $canteenMenu)
    {
        if ($canteenMenu->delete()) {
            return redirect()->route('canteen-menu.index')
                ->with('alert', "Berhasil menghapus menu kantin.")
                ->with('type', 'success');
        }else{
            return redirect()->back()
                ->with('alert', "Terjadi Kesalahan pada sistem, coba lagi nanti.")
                ->with('type', 'danger');
        }
    }

    public function data(){
        return response()->json(CanteenMenu::where('status', 'available')->get());
    }
}
