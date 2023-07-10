@extends('dashboard.layouts.main')

@section('container')
    <div class="row">
        <div class="col-lg-5 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-five">
                        <div class="stat-icon dib flat-color-1">
                            <div class="stat-text">Data Service</div>
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
                    <strong class="card-title">Data Service</strong>
                    <a href="/dashboard/service/create" class="btn btn-secondary float-right">Tambah</a>
                </div>
                <div class="card-body">
                    <table id="bootstrap-data-table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Service</th>
                                <th>Harga</th>
                                <th>Waktu</th>
                                <th>Deskripsi</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($services as $service)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $service->name }}</td>
                                    <td>{{ $service->harga }}</td>
                                    <td>{{ $service->waktu }}</td>
                                    <td>{!! $service->deskripsi !!}</td>
                                    <td><img src="{{ asset('storage/' . $service->image) }}" alt="Gambar"></td>
                                    <td>
                                        <a href="/dashboard/service/{{ $service->id }}/edit"
                                            class="btn btn-warning">Edit</a>
                                        <form action="/dashboard/service/{{ $service->id }}" method="post"
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
