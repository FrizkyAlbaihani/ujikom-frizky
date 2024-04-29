@extends('layouts.app2')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                           Tambah Order
                        </button>
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
                                                <input type="text" class="form-control" value="{{$kode}}" name="kode" id="kode" readonly>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="nama">Nama Konsumen</label>
                                                <select name="" id="" class="form-control">
                                                    <option value="">- Pilih -</option>
                                                    @foreach ($konsumen as $item)
                                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="nama">Jenis Layanan</label>
                                                <select name="layanan" id="layanan" class="form-control">
                                                    <option value="">- Pilih -</option>
                                                    @foreach ($layanan as $item)
                                                        <option value="{{ $item->id }}" data-harga="{{ $item->harga }}">{{ $item->nama }}</option>
                                                    @endforeach
                                                </select>                                                
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="nama">Jenis Pembayaran</label>
                                                <select name="" id="" class="form-control">
                                                    <option value="">- Pilih -</option>
                                                    @foreach ($pembayaran as $item)
                                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="nama">Status Pembayaran</label>
                                                <select name="" id="" class="form-control">
                                                    <option value="">Pilih - -</option>
                                                        <option value="belum_lunas">Belum Lunas</option>
                                                        <option value="lunas"> Lunas</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="harga">Harga</label>
                                                <input type="number" class="form-control" name="harga" id="harga" placeholder="" readonly>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="jumlah">Jumlah</label>
                                                <input type="number" class="form-control" name="jumlah" id="jumlah" placeholder="">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="total_harga">Total Harga</label>
                                                <input type="number" class="form-control" name="total_harga" id="total_harga" placeholder="" readonly>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="uang_bayar">Uang Bayar</label>
                                                <input type="number" class="form-control" name="uang_bayar" id="uang_bayar" placeholder="">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="uang_kembalian">Kembalian</label>
                                                <input type="number" class="form-control" name="uang_kembalian" id="uang_kembalian" placeholder="">
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
                                <th>Total</th>
                                <th>Status Bayar</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($data as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->konsumen->nama }}</td>
                                <td>{{ Carbon\Carbon::parse($item->tanggal)->format('d-M-Y') }}</td>
                                <td>{{ $item->kode }}</td>
                                <td>{{ $item->layanan->nama}}</td>
                                <td>{{ $item->total_harga}}</td>
                                <td>{{ $item->status_pembayaran}}</td>
                                <td>{{ $item->status}}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center">
                                        <button type="button" class="btn btn-primary mb-1 me-1 btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                                            Edit
                                        </button>
                                        <form action="{{ route('konsumen.destroy', $item->id) }}" method="POST" id="deleteForm">
                                            @csrf
                                            @method('delete')
                                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete()">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                    <!-- Modal Edit-->
                                    <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                            <form action="{{ route('konsumen.update', $item->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" value="{{ $item->nama }}" name="nama" id="nama" placeholder="" >
                                                        <label for="nama">Nama Konsumen</label>
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <input type="number" class="form-control" value="{{ $item->no_hp }}" name="no_hp" id="no_hp" placeholder="" >
                                                        <label for="no_hp">No HP</label>
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <textarea name="alamat" id="alamat" class="form-control">{{ $item->alamat }}</textarea>
                                                        <label for="alamat">Alamat</label>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach --}}
                        </tbody>
                    </table>
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
<script>
    document.getElementById('layanan').addEventListener('change', function(){
        updatePrice();
        updateTotalPrice();
    });

    document.getElementById('jumlah').addEventListener('input', function(){
        updateTotalPrice();
    });

    function updatePrice(){
        var selectedServiceId = document.getElementById('layanan').value;
        var selectedOption = document.getElementById('layanan').options[document.getElementById('layanan').selectedIndex];
        var harga = parseFloat(selectedOption.getAttribute('data-harga'));
        
        document.getElementById('harga').value = isNaN(harga) ? '' : harga;
    }

    function updateTotalPrice(){
        var quantity = parseInt(document.getElementById('jumlah').value);
        var harga = parseFloat(document.getElementById('harga').value);
        var totalPrice = harga * quantity;

        document.getElementById('total_harga').value = isNaN(totalPrice) ? '' : totalPrice;
    }
</script>

@endsection
