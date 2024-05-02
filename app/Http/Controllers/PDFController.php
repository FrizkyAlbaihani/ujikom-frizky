<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\PDF;

class PDFController extends Controller
{
    public function generatePDF(PDF $pdf){

        $order = Order::latest()->get();

        $pdf->loadView('pdf.laporan', compact('order'))->setPaper('a4', 'landscape');

        return $pdf->stream('laporan.pdf');
    }

    public function generateStruk(PDF $pdf, $id)
    {
        $order = Order::findOrFail($id);

        $pdf->loadView('pdf.struk', compact('order'))->setPaper('a7', 'potrait');

        return $pdf->stream('struk.pdf');
    }
}
