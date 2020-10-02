<?php

namespace App\Http\Controllers;

use App\Models\CanteenMenu;
use App\Models\Dashboard;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'p_group' => '',
            'p_name' => 'dashboard',
            'users' => User::all(),
            'menus' => CanteenMenu::all(),
            'orders' => Order::all(),
            'transactions' => Transaction::all(),
        ];
        return view('dashboard', $data);
    }
}
