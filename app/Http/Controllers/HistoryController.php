<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
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
     * Get the query builder
     *
     * @return array
     */
    protected function getData()
    {
        $user = Auth::user();
        $lastOperations = $user->balance->transactions->sortByDesc('id')->values()->toArray();

        return ['data' => $lastOperations];
    }


    /**
     * Show the application dashboard.
     *
     * @return Renderableuse Illuminate\Http\Request;
     */
    public function index()
    {
        return view('history');
    }
}
