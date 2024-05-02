@extends('layouts.app2')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header mb-3"><h4>History Order</h4></div>
                    <div class="d-flex justify-content-end">
                        <input class="form-control w-20" type="text" id="search" placeholder="Search.." name="search">
                        <button type="button" id="searchBtn" class="btn btn-primary btn-sm text-center mr-3 " style="height: 38px"><i class="fa fa-search ml-1 mr-1"></i></button>
                        <button type="button" class="btn btn-danger mb-3 me-3" id="generatePdfBtn">
                            Generate PDF
                        </button>
                        @if(Auth::user()->role !== 'pemimpin')
                        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Tambah Order
                        </button>
                        @endif
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Order</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('order.store') }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label for="kode">Kode Orderan</label>
                                                    <input type="text" class="form-control" value="{{$kodes}}" name="kode" id="kode" readonly>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="nama">Nama Konsumen</label>
                                                    <select name="id_konsumen" id="id_konsumen" class="form-control">
                                                        <option value="">- Pilih -</option>
                                                        @foreach ($konsumen as $item)
                                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="nama">Jenis Layanan</label>
                                                    <select name="id_layanan" id="id_layanan" class="form-control">
                                                        <option value="">- Pilih -</option>
                                                        @foreach ($layanan as $item)
                                                        <option value="{{ $item->id }}" data-harga="{{ $item->harga }}">{{ $item->nama }}</option>
                                                        @endforeach
                                                    </select>                                                
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="nama">Jenis Pembayaran</label>
                                                    <select name="id_pembayaran" id="id_pembayaran" class="form-control">
                                                        <option value="">- Pilih -</option>
                                                        @foreach ($pembayaran as $item)
                                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="harga">Harga</label>
                                                    <input type="number" class="form-control" name="harga" id="harga" placeholder="" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                
                                                <div class="form-group mb-3">
                                                    <label for="jumlah">Jumlah</label>
                                                    <input type="number" class="form-control" name="jumlah" id="jumlah" min="0" max="50" placeholder="" oninput="validity.valid||(value='');">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="total_harga">Total Harga</label>
                                                    <input type="number" class="form-control" name="total_harga" id="total_harga" placeholder="" readonly>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="uang_bayar">Uang Bayar</label>
                                                    <input type="number" class="form-control" name="uang_bayar" id="uang_bayar" min="0" oninput="validity.valid||(value='');" placeholder="">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="uang_kembalian">Kembalian</label>
                                                    <input type="number" class="form-control" name="uang_kembalian" min="0" oninput="validity.valid||(value='');" id="uang_kembalian" placeholder="" readonly>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="nama">Status Pembayaran</label>
                                                    <select name="status_pembayaran" id="status_pembayaran" class="form-control" @readonly(true)>
                                                        <option value="">Pilih - -</option>
                                                        <option value="belum_lunas">Belum Lunas</option>
                                                        <option value="lunas"> Lunas</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Tambah</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th>Tanggal</th>
                                <th>Nama Konsumen</th>
                                <th>Kode Orderan</th>
                                <th>Layanan</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                                <th class="text-center">Status Bayar</th>
                                <th class="text-center"> Status</th>
                                @if(Auth::user()->role !== 'pemimpin')
                                <th class="text-center">Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @if ($order->isEmpty())
                            <tr>
                                <td colspan="9" class="text-center">Data Kosong</td>
                            </tr>
                            @else
                            @endif
                            @foreach ($order as $item)
                            <tr>
                                <td class="text-center">{{ $loop->index + 1 + ($order->currentPage() - 1) * $order->perPage() }}</td>
                                <td>{{ Carbon\Carbon::parse($item->tanggal)->format('d-M-Y') }}</td>
                                <td>{{ $item->konsumen->nama ?? '' }}</td>
                                <td>{{ $item->kode }}</td>
                                <td>{{ $item->layanan->nama ?? ''}}</td>
                                <td>{{ $item->jumlah}}</td>
                                <td>Rp. {{ $item->total_harga}}</td>
                                <td class="text-center">
                                    <span class="badge @if($item->status_pembayaran === 'belum_lunas') bg-danger @else bg-primary @endif">
                                        {{ ucfirst(str_replace('_', ' ',$item->status_pembayaran)) }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span class="badge 
                                    @if($item->status == 'baru') bg-info
                                    @elseif($item->status == 'proses') bg-warning 
                                    @elseif($item->status == 'selesai') bg-primary 
                                    @elseif($item->status == 'diambil') bg-success 
                                    @endif">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                            @if(Auth::user()->role !== 'pemimpin')
                            <td class="text-center">
                                <div class="d-flex justify-content-center">
                                    <button type="button" class="btn btn-primary mb-1 me-1 btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                                        Edit
                                    </button>
                                    <form action="{{ route('order.destroy', $item->id) }}" method="POST" id="deleteForm">
                                        @csrf
                                        @method('delete')
                                        <button type="button" class="btn btn-danger mr-1 btn-sm" onclick="confirmDelete()">
                                            Delete
                                        </button>
                                    </form>
                                    <button type="button" class="btn btn-warning text-white mb-1 me-1 btn-sm generate-struk-btn" id="generateStruk" data-id="{{ $item->id }}">Struk</button>
                                </div>
                                <!-- Modal Edit-->
                                <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalEdit" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalEdit">Edit Modal</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('order.update', $item->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group mb-3">
                                                                <label for="kode">Kode Orderan</label>
                                                                <input type="text" class="form-control" value="{{$item->kode}}" name="kode" id="kode" readonly>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="nama">Nama Konsumen</label>
                                                                <select name="id_konsumen" id="id_konsumen" class="form-select" @readonly(true)>
                                                                    <option value="{{ $item->konsumen->id }}">{{ $item->konsumen->nama }}</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="nama">Jenis Layanan</label>
                                                                <select name="id_layanan" id="id_layanan" class="form-select" @readonly(true)>
                                                                    <option value="{{ $item->layanan->id }}">{{ $item->layanan->nama }}</option>
                                                                </select>                                                            
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="nama">Jenis Pembayaran</label>
                                                                <select name="id_pembayaran" id="id_pembayaran" class="form-select" @readonly(true)>
                                                                    <option value="{{ $item->pembayaran->id }}">{{ $item->pembayaran->nama }}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group mb-3">
                                                                <label for="harga">Harga</label>
                                                                <input type="number" class="form-control" value="{{ $item->layanan->harga }}" name="harga" id="harga" placeholder="" readonly>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="jumlah">Jumlah</label>
                                                                <input type="number" class="form-control" value="{{ $item->jumlah }}" name="jumlah" id="jumlah" placeholder="" readonly>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="total_harga">Total Harga</label>
                                                                <input type="number" class="form-control" value="{{  $item->total_harga }}" name="total_harga" id="total_harga" placeholder="" readonly>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="status_pembayaran">Status Pembayaran</label>
                                                                <select name="status_pembayaran" id="status_pembayaran" class="form-select">
                                                                    <option value="belum_lunas" {{ $item->status_pembayaran === 'belum_lunas' ? 'selected' : '' }}>Belum Lunas</option>
                                                                    <option value="lunas" {{ $item->status_pembayaran === 'lunas' ? 'selected' : '' }}>Lunas</option>
                                                                </select>
                                                            </div>
                                                            {{-- <div class="form-group mb-3">
                                                                <label for="uang_bayar">Uang Bayar</label>
                                                                <input type="number" class="form-control" value="{{ $item->uang_bayar }}" name="uang_bayar" id="uang_bayar" placeholder="">
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="uang_kembalian">Kembalian</label>
                                                                <input type="number" class="form-control" value="{{ $item->uang_kembalian }}" name="uang_kembalian" id="uang_kembalian" placeholder="" readonly>
                                                            </div> --}}
                                                        </div>
                                                        <label for="status">Status</label>
                                                        <div class="col-md-12">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" name="status" type="radio" id="status" value="baru" {{ $item->status === 'baru' ? 'checked' : '' }} {{ $item->status === 'diambil' ? 'disabled' : '' }}>
                                                                <label class="form-check-label" for="status">Baru</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" name="status" type="radio" id="status" value="proses" {{ $item->status === 'proses' ? 'checked' : '' }} {{ $item->status === 'diambil' ? 'disabled' : '' }}>
                                                                <label class="form-check-label" for="status">Proses</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" name="status" type="radio" id="status" value="selesai" {{ $item->status === 'selesai' ? 'checked' : '' }} {{ $item->status === 'diambil' ? 'disabled' : '' }}>
                                                                <label class="form-check-label" for="status">Selesai</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" name="status" type="radio" id="status" value="diambil" {{ $item->status === 'diambil' ? 'checked' : '' }} {{ $item->status === 'diambil' ? 'disabled' : '' }}>
                                                                <label class="form-check-label" for="status">Diambil</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-left">
                    {{ $order->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script>
    function confirmDelete() {
        if (confirm("Kamu yakin akan menghapus data ini?")) {
            document.getElementById('deleteForm').submit();
        }
    }
    
    document.getElementById('generatePdfBtn').addEventListener('click', function() {
        window.location.href = '/laporan-pdf';
    });

    
    //struk
    var generateStrukBtns = document.querySelectorAll('.generate-struk-btn');

        generateStrukBtns.forEach(function(btn) {
            btn.addEventListener('click', function() {
                var orderId = this.getAttribute('data-id');
                
                window.location.href = '/struk-pdf/' + orderId;
            });
        });
    
    document.getElementById('searchBtn').addEventListener('click', function() {
        var searchTerm = document.getElementById('search').value;
        window.location.href = '/order?search=' + searchTerm;
    });
    //
    document.getElementById('id_layanan').addEventListener('change', function(){
        updatePrice();
        updateTotalPrice();
    });
    
    document.getElementById('jumlah').addEventListener('input', function(){
        updateTotalPrice();
    });
    
    //hitung
    function updatePrice(){
        var selectedServiceId = document.getElementById('id_layanan').value;
        var selectedOption = document.getElementById('id_layanan').options[document.getElementById('id_layanan').selectedIndex];
        var harga = parseFloat(selectedOption.getAttribute('data-harga'));
        
        
        document.getElementById('harga').value = isNaN(harga) ? '' : harga;
    }
    
    function updateTotalPrice(){
        var quantity = parseInt(document.getElementById('jumlah').value);
        var harga = parseFloat(document.getElementById('harga').value);
        var totalPrice = harga * quantity;
        var uangBayar = parseFloat(document.getElementById('uang_bayar').value);
        
        document.getElementById('total_harga').value = isNaN(totalPrice) ? '' : totalPrice;
        
        var uangKembalian = uangBayar - totalPrice;

        if (!isNaN(uangkembalian) && uangkembalian >= 0) {
                document.getElementById('uang_kembalian').value = kembalian;
            } else {
                document.getElementById('uang_kembalian').value = 'Uang bayar kurang';
            }
        
        document.getElementById('uang_kembalian').value = isNaN(uangKembalian) ? '' : uangKembalian;
        document.getElementById('uang_bayar').addEventListener('input', function(){
            updateTotalPrice();
        });
    }
    
    document.getElementById('uang_bayar').addEventListener('input', function(){
        updateTotalPriceAndPaymentStatus();
    });
    
    function updateTotalPriceAndPaymentStatus(){
        var quantity = parseInt(document.getElementById('jumlah').value);
        var harga = parseFloat(document.getElementById('harga').value);
        var totalPrice = harga * quantity;
        var uangBayar = parseFloat(document.getElementById('uang_bayar').value);
        var statusPembayaranField = document.getElementById('status_pembayaran');
        
        // // Validasi input jumlah
        // if (quantity <= 0 || isNaN(quantity)) {
        //     alert("Jumlah harus lebih besar dari 0.");
        //     document.getElementById('jumlah').value = 0;
        //     quantity = 0;
        // }
        
        // // Validasi input uang bayar
        // if (uangBayar <= 0 || isNaN(uangBayar)) {
        //     alert("Uang bayar harus lebih besar dari 0.");
        //     document.getElementById('uang_bayar').value = 0;
        //     uangBayar = 0;
        // }
        
        document.getElementById('total_harga').value = isNaN(totalPrice) ? '' : totalPrice;
        
        var uangKembalian = uangBayar - totalPrice;
        
        document.getElementById('uang_kembalian').value = isNaN(uangKembalian) ? '' : uangKembalian;
        
        // Check if the payment is more than or equal to the total price
        if (uangBayar >= totalPrice) {
            statusPembayaranField.value = 'lunas';
        } else {
            statusPembayaranField.value = ''; // Reset the status field if payment is insufficient
        }

         // Tambahkan event listener untuk mengupdate total harga dan status pembayaran saat uang bayar berubah
    document.getElementById('uang_bayar').addEventListener('input', function(){
        updateTotalPriceAndPaymentStatus();
    });
        
        // // Set status pembayaran
        // if (uangBayar < totalPrice) {
        //     statusPembayaranField.value = 'belum_lunas';
        // } else {
        //     statusPembayaranField.value = ''; // Reset the status field if payment is sufficient
        // }
    }
    
</script>

{{-- <script>
    document.getElementById('layanan').addEventListener('uang_kembalian', function(){
        updateTotalprice();
        updateQuantityLabel();
        updatePaymentStatusOption();
    });
    
    document.getElementById('jumlah').addEventListener('input', function(){
        updateTotalprice();
    });
    
    document.getElementById('harga').addEventListener('input', function(){
        updatePaymentStatusOption();
        updateChange();
    });
    
    function updateTotalPrice(){
        var selectedServiceId = document.getElementById('layanan').value;
        var quantity = parseInt(document.getElementById('jumlah').value);
        var serviceOptions = ;
        var totalPrice = 0;
        
        for(var i = 0; i< serviceOptions.length; i++){
            if(serviceOptions[i].id == selectedServiceId) {
                totalPrice = serviceOptions[i].price * quantity;
                break;
            }
        }
        document.getElementById('total_harga').value = totalPrice;
    }
    
</script> --}}

@endsection
