<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $lastOperations = $user->balance->transactions->sortByDesc('id')->toArray();

        return view('main', [
            'balance'        => $user->balance->balance,
            'lastOperations' => $lastOperations
        ]);
    }
}
