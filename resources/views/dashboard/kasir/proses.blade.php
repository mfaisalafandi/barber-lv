@extends('dashboard.layouts.main')

@section('container')
    <div class="row">
        <div class="col-lg-5 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-five">
                        <div class="stat-icon dib flat-color-1">
                            <div class="stat-text">Pelayanan</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (session()->has('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif
    <div class="row">
        <div class="col-lg-8">
            <form method="POST" action="/dashboard/kasir" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                    <label for="name" class="form-label">Nama Pelanggan</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        id="name" value="{{ old('name', $booking->user->pelanggan->name) }}" readonly />
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="karyawan" class="form-label">Karyawan</label>
                    <input type="text" name="karyawan_id" class="form-control @error('karyawan_id') is-invalid @enderror"
                        id="karyawan_id" value="{{ old('karyawan_id', $booking->karyawan->name) }}" readonly />
                    @error('karyawan_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="total_harga" class="form-label">Total Harga (Rp.)</label>
                    <input type="number" name="total_harga" class="form-control @error('total_harga') is-invalid @enderror"
                        id="total_harga" value="{{ old('total_harga', $booking->total_harga) }}" readonly />
                    @error('total_harga')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="bayar" class="form-label">Bayar (Rp.)</label>
                    <input type="number" name="bayar" class="form-control @error('bayar') is-invalid @enderror"
                        id="bayar" value="{{ old('bayar', $booking->bayar) }}" />
                    @error('bayar')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
