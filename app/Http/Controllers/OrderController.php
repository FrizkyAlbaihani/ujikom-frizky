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
    public function index(Request $request)
    {
        $layanan = Layanan::all();
        $konsumen = Konsumen::all();
        $pembayaran = Pembayaran::all();
        $orderterakhir = Order::latest()->first();
        $kodes = $orderterakhir ? 'KDKN-' . (intval(substr($orderterakhir->kode, 5)) + 1) : 'KDKN-1';
        $order = Order::with(['konsumen', 'layanan', 'pembayaran'])->latest();

        if ($request->filled('search') && $request->search != '') {
            $order->where('kode', 'like', '%' . $request->search . '%');
        }

        $order = $order->simplePaginate(10);

        $searchTerm = $request->input('search');

    $orders = Order::query()
        ->when($searchTerm, function ($query, $searchTerm) {
            $query->whereHas('konsumen', function ($query) use ($searchTerm) {
                $query->where('nama', 'like', '%' . $searchTerm . '%');
            });
        })
        ->get();

        return view('order.index', compact('konsumen', 'order', 'layanan', 'pembayaran', 'kodes'));
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
            // 'uang_bayar' => 'required',
            // 'uang_kembalian' => 'required'
        ];

        $request->validate($rules);

        $data = [
            'kode' => $request->kode,
            'id_konsumen' => $request->id_konsumen,
            'id_layanan' => $request->id_layanan,
            'id_pembayaran' => $request->id_pembayaran,
            'harga' => $request->harga,
            'status_pembayaran' => $request->status_pembayaran,
            'jumlah' => $request->jumlah,
            'total_harga' => $request->total_harga,
            // 'uang_bayar' => $request->uang_bayar,
            // 'uang_kembalian' => $request->uang_kembalian,
            
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
        $rules = [
            'kode' => 'required',
            'id_konsumen' => 'required',
            'id_layanan' => 'required',
            'id_pembayaran' => 'required',
            'status_pembayaran' => 'required',
            'jumlah' => 'required',
            'total_harga' => 'required',
            // 'uang_bayar' => 'required',
            // 'uang_kembalian' => 'required',
            'status' => 'required'
        ];

        $request->validate($rules);

        $data = [
            'kode' => $request->kode,
            'id_konsumen' => $request->id_konsumen,
            'id_layanan' => $request->id_layanan,
            'id_pembayaran' => $request->id_pembayaran,
            'harga' => $request->harga,
            // 'pembayaran' => $request->pembayaran,
            'status_pembayaran' => $request->status_pembayaran,
            'jumlah' => $request->jumlah,
            'total_harga' => $request->total_harga,
            // 'uang_bayar' => $request->uang_bayar,
            // 'uang_kembalian' => $request->uang_kembalian,
            'status' => $request->status,
            
        ];


        Order::find($id)->update($data);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Order::find($id)->delete();
        return redirect()->back();
    }

}
