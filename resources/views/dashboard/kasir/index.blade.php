@extends('dashboard.layouts.main')

@section('container')
    <div class="row">
        <div class="col-lg-5 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-five">
                        <div class="stat-icon dib flat-color-1">
                            <div class="stat-text">Menu Kasir</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Proses Pembayaran</strong>
                </div>
                <div class="card-body">
                    <table id="bootstrap-data-table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Karyawan</th>
                                <th>Tanggal</th>
                                <th>Jam</th>
                                <th>Bukti DP</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kasirs as $kasir)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $kasir->user->pelanggan->name }}</td>
                                    <td>{{ $kasir->karyawan->name }}</td>
                                    <td>{{ $kasir->jadwal->tanggal }}</td>
                                    <td>{{ $kasir->jadwal->waktu_awal }} - {{ $kasir->jadwal->waktu_akhir }}</td>
                                    <td><img src="{{ asset('storage/' . $kasir->image) }}" alt="Gambar"></td>
                                    <td>
                                        <a href="/dashboard/kasir/{{ $kasir->id }}" class="btn btn-warning">Proses</a>
                                        <form action="/dashboard/kasir/{{ $kasir->id }}" method="post" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-danger border-0"
                                                onclick="return confirm('Apakah yakin?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
