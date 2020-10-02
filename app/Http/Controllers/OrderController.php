<?php

namespace App\Http\Controllers;

use App\Models\CanteenMenu;
use App\Models\Order;
use App\Models\Table;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function index()
    {
        $order = DB::table('orders')
            ->join('canteen_menus', 'canteen_menus.id', '=', 'orders.canteen_menu_id')
            ->join('transactions', 'transactions.id', '=', 'orders.transaction_id')
            ->orderBy('orders.status', 'asc')
            ->orderBy('orders.updated_at', 'desc')
            ->select(
                'transactions.id AS trs_id',
                'orders.id',
                'orders.quantity', 
                'orders.total', 
                'orders.notes',
                'orders.status',
                'canteen_menus.name', 
                'canteen_menus.price'
            )->get();

        $table = [];
        foreach ($order as $o) {
            $table_id = Transaction::find($o->trs_id)->table_id;
            $table[] = Table::find($table_id);
        }
        
        $data = [
            'p_name' => 'order',
            'orders' => $order,
            'tables' => $table,
        ];
        return view('order.index', $data);
    }

    public function create()
    {
        $data = [
            'p_name' => 'order',
        ];
        return view('order.create', $data);
    }

    public function store(Request $request)
    {
        $check = Transaction::where('table_id', $request->meja)->where('status', 'unpaid')->first();
        $transaction_id = $check ? $check->id : '';
        if ($transaction_id == '') {
            $transaction = new Transaction();
            $transaction->table_id = $request->meja;
            $transaction->date = date('Y-m-d', strtotime(now()));
            $transaction->status = "unpaid";
            $transaction->save();
            $transaction_id = Transaction::orderBy('id', 'desc')->first()->id;
        }

        $order = new Order();
        $order->transaction_id = $transaction_id;
        $order->user_id = Session::get('user_id');
        $order->canteen_menu_id = $request->menu;
        $order->quantity = $request->kuantitas;
        $order->total = CanteenMenu::find($request->menu)->price * $request->kuantitas;
        $order->notes = $request->catatan == NULL ? "-" : $request->catatan ;
        $order->status = "proses";

        if($order->save()){
            return response()->json(['msg' => 'Berhasil menambahkan pesanan.']);
        }else{
            return response()->json(['msg' => 'Gagal menambahkan pesanan.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    public function data(Request $request){
        $data = DB::table('transactions')
            ->join('orders', 'transactions.id', '=', 'orders.transaction_id')
            ->join('canteen_menus', 'orders.canteen_menu_id', '=', 'canteen_menus.id')
            ->select('orders.*', 'canteen_menus.name')
            ->where('transactions.table_id', $request->meja)
            ->where('transactions.status', 'unpaid')
            ->orderBy('orders.status', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($data);
    }

    public function done(Request $request){
        $update = ['status' => 'selesai'];
        if (Order::find($request->id)->update($update)) {
            return response()->json(['status' => 'success']);
        }else{
            return response()->json(['status' => 'failed']);
        }
    }

    public function cancel(Request $request){
        if (Order::find($request->id)->delete()) {
            return response()->json(['status' => 'success']);
        }else{
            return response()->json(['status' => 'failed']);
        }
    }
}
