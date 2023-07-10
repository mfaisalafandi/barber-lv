@extends('dashboard.layouts.main')

@section('container')
    <div class="row">
        <div class="col-lg-5 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-five">
                        <div class="stat-icon dib flat-color-1">
                            <div class="stat-text">Data Karyawan</div>
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
                    <strong class="card-title">Data Karyawan</strong>
                    <a href="/dashboard/karyawan/create" class="btn btn-secondary float-right">Tambah</a>
                </div>
                <div class="card-body">
                    <table id="bootstrap-data-table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Telepon</th>
                                <th>Alamat</th>
                                <th>Cabang</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($karyawans as $karyawan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $karyawan->name }}</td>
                                    <td>{{ $karyawan->jk }}</td>
                                    <td>{{ $karyawan->telp }}</td>
                                    <td>{!! $karyawan->alamat !!}</td>
                                    <td>{!! $karyawan->cabang->name !!}</td>
                                    <td><img src="{{ asset('storage/' . $karyawan->image) }}" alt="Gambar"></td>
                                    <td>
                                        <a href="/dashboard/karyawan/{{ $karyawan->id }}/edit"
                                            class="btn btn-warning">Edit</a>
                                        <form action="/dashboard/karyawan/{{ $karyawan->id }}" method="post"
                                            class="d-inline">
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
