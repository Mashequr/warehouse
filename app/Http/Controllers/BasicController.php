<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BasicController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $client_count = DB::table('clients')->count();
        $stock_count = DB::table('stocks')->count();
        return view('dashboard',['client_count' => $client_count,'stock_count' => $stock_count ]);
    }
}
