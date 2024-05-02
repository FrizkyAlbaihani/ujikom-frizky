<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KonsumenController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\UserMiddleware;
use App\Models\Konsumen;
use App\Models\Layanan;
use App\Models\Order;
use App\Models\Pembayaran;
use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function (Request $request) {
    $konsumen = Konsumen::latest()->get();
        $layanan = Layanan::latest()->get();
        $pembayaran = Pembayaran::latest()->get();
        $order = Order::with(['konsumen', 'pembayaran', 'layanan']);

        if ($request->filled('search') && $request->search != '') {
            $order->where('kode', 'like', '%' . $request->search . '%');
        }

        $order = $order->simplePaginate(10);

        return view('welcome', compact('order', 'request', 'konsumen', 'layanan', 'pembayaran'));
})->name('welcome');

Auth::routes();
Route::middleware(['auth'])->group(function () {
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::resource('/konsumen', KonsumenController::class,['expect'=>['show']]);
Route::resource('/order', OrderController::class,['expect'=>['show']]);
Route::get('/laporan-pdf', [PDFController::class, 'generatePDF'])->name('laporan.pdf');
Route::get('/struk-pdf/{id}', [PDFController::class, 'generateStruk'])->name('struk.pdf');
Route::resource('/layanan', LayananController::class, ['except' => ['show']]);

Route::middleware([UserMiddleware::class . ':admin'])->group(function () {
    Route::resource('/petugas', PetugasController::class, ['except' => ['show']]);
    Route::resource('/pembayaran', PembayaranController::class, ['except' => ['show']]);
});
});