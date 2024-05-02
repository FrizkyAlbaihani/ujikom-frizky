<?php

namespace App\Http\Controllers;
use App\Models\Konsumen;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $pendapatan = Order::whereDate('created_at', Carbon::today())->sum('total_harga');
        $pendapatanBulanan = Order::whereYear('created_at', Carbon::now()->year)
                                ->whereMonth('created_at', Carbon::now()->month)
                                ->sum('total_harga');
        $order = Order::count();
        $konsumen = Konsumen::count();

        return view('home', compact( 'order', 'konsumen', 'pendapatan', 'pendapatanBulanan'));
    }
}
