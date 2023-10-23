<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $balance = Auth::user()->balance;

        return [
            'balance'      => $balance->balance,
            'transactions' => $balance->transactions->sortByDesc('id')->take(5)->values()
        ];
    }
}
