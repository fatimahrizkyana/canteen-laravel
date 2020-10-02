<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TransactionController extends Controller
{
    public function index()
    {
        $transaction = DB::table('transactions')
            ->join('tables', 'tables.id', '=', 'transactions.table_id')
            ->orderBy('transactions.created_at', 'desc')
            ->orderBy('transactions.status', 'desc')
            ->get();

        $data = [
            'p_name' => 'transaction',
            'transactions' => $transaction,
        ];
        return view('transaction.index', $data);
    }

    public function create()
    {
        $data = [
            'p_name' => 'transaction',
        ];
        return view('transaction.create', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'meja' => ['required', Rule::notIn('NULL')],
            'total' => ['required'],
            'cash' => ['required'],
            'change' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'failed', 'msg' => 'Isikan form dengan benar']);
        }else{
            $update = [
                'cash' => $request->cash,
                'change' => $request->change,
                'status' => 'paid',
                'user_id' => Session::get('user_id'),
            ];
            $transaction_id = Transaction::where('table_id', $request->meja)->where('status', 'unpaid')->first()->id;
            $updating = Order::where('transaction_id', $transaction_id)->update(['status' => 'selesai']);
            $updating = Transaction::where('table_id', $request->meja)->where('status', 'unpaid')->update($update);
            if ($updating) {
                return response()->json(['status' => 'success', 'msg' => 'Berhasil melakukan transaksi.']);
            }else{
                return response()->json(['status' => 'failed', 'msg' => 'Terjadi kesalahan pada sistem, coba lagi nanti.']);
            }
        }
    }

    public function show(Transaction $transaction)
    {
        //
    }

    public function edit(Transaction $transaction)
    {
        //
    }

    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    public function destroy(Transaction $transaction)
    {
        //
    }

    public function data(Request $request){
        $data = DB::table('transactions')
            ->where('transactions.table_id', $request->meja)
            ->where('transactions.status', 'unpaid')
            ->join('orders', 'transactions.id', '=', 'orders.transaction_id')
            ->join('canteen_menus', 'orders.canteen_menu_id', '=', 'canteen_menus.id')
            ->select('orders.*', 'canteen_menus.*', 'transactions.*')
            ->get();

        $total = 0;
        foreach ($data as $d) {
            $total += $d->price * $d->quantity;
        }
        $update = ['total' => $total];
        $updating = Transaction::where('table_id', $request->meja)
            ->where('status', 'unpaid')->update($update);
        if ($updating && $data != NULL) {
            return response()->json($data);
        }else{
            return response()->json([]);
        }
    }
}
