<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function index()
    {
        $table = Table::all();
        $data = [
            'p_name' => 'table',
            'tables' => $table
        ];
        return view('table.index', $data);
    }

    public function create()
    {
        $data = [
            'p_name' => 'table',
        ];
        return view('table.create', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nomor_meja' => 'required',
        ]);

        $data = new Table();
        $data->number = $request->nomor_meja;

        if ($data->save()) {
            return redirect()->route('table.index')
                ->with('alert', "Berhasil menambahkan meja.")
                ->with('type', 'success');
        }else{
            return redirect()->back()
                ->with('alert', "Terjadi Kesalahan pada sistem, coba lagi nanti.")
                ->with('type', 'danger');
        }
    }

    public function show(Table $table)
    {
        //
    }

    public function edit(Table $table)
    {
        $data = [
            'p_name' => 'table',
            'table' => $table,
        ];
        return view('table.edit', $data);
    }

    public function update(Request $request, Table $table)
    {
        $this->validate($request, [
            'nomor_meja' => 'required',
        ]);

        if ($table->update(['number' => $request->nomor_meja])) {
            return redirect()->route('table.index')
                ->with('alert', "Berhasil mengubah meja.")
                ->with('type', 'success');
        }else{
            return redirect()->back()
                ->with('alert', "Terjadi Kesalahan pada sistem, coba lagi nanti.")
                ->with('type', 'danger');
        }
    }

    public function destroy(Table $table)
    {
        if ($table->delete()) {
            return redirect()->route('table.index')
                ->with('alert', "Berhasil menghapus meja.")
                ->with('type', 'success');
        }else{
            return redirect()->back()
                ->with('alert', "Terjadi Kesalahan pada sistem, coba lagi nanti.")
                ->with('type', 'danger');
        }
    }

    public function data(){
        return response()->json(Table::all());
    }
}
