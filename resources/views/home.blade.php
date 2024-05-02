@extends('layouts.app2')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="row">
            <div class="col-lg-4 col-sm-6">
                <div class="card">
                    <div class="stat-widget-two card-body">
                        <div class="stat-content">
                            <div class="stat-text">Total Konsumen</div>
                            <div class="stat-digit"><i class="fa fa-users"></i> {{ $konsumen }}</div> <!-- Ubah nilai variabel sesuai dengan data yang diambil dari database -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="card">
                    <div class="stat-widget-two card-body">
                        <div class="stat-content">
                            <div class="stat-text">Pendapatan Harian</div>
                            <div class="stat-digit">Rp. {{ $pendapatan }}</div> <!-- Ubah nilai variabel sesuai dengan data yang diambil dari database -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="card">
                    <div class="stat-widget-two card-body">
                        <div class="stat-content">
                            <div class="stat-text">Pendapatan Bulanan</div>
                            <div class="stat-digit">Rp. {{ $pendapatanBulanan }}</div> <!-- Anda perlu menambahkan logika atau fungsi untuk menghitung pendapatan bulanan -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection
