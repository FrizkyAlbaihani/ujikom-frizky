<?php

namespace App\Http\Controllers;

use App\Models\Konsumen;
use App\Models\Order;
use App\Models\Layanan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $konsumen = Konsumen::all();
        $order = Order::all();
        $layanan = Layanan::all();
        $pembayaran = Pembayaran::all();
        $orderterakhir = Order::latest()->first();
        $kode = $orderterakhir ? 'KDKN-' . (intval(substr($orderterakhir->kode, 5)) + 1) : 'KDKN-1';

        return view('order.index', compact('konsumen', 'order', 'layanan', 'pembayaran', 'kode'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'kode' => 'required',
            'id_konsumen' => 'required',
            'id_layanan' => 'required',
            'id_pembayaran' => 'required',
            'status_pembayaran' => 'required',
            'jumlah' => 'required',
            'total_harga' => 'required',
            'uang_bayar' => 'required',
            'uang_kembalian' => 'required'
        ];

        $request->validate($rules);

        $data = [
            'nama' => $request->nama,
            'harga' => $request->harga,
            
        ];

        Order::create($data);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
