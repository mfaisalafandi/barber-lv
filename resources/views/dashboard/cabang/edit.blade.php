@extends('dashboard.layouts.main')

@section('container')
    <div class="row">
        <div class="col-lg-5 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-five">
                        <div class="stat-icon dib flat-color-1">
                            <div class="stat-text">Data Cabang</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <form method="POST" action="/dashboard/cabang/{{ $cabang->id }}">
                @csrf
                @method('put')
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Cabang</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        id="name" value="{{ old('name', $cabang->name) }}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="telp" class="form-label">Telepon</label>
                    <input type="text" name="telp" class="form-control" id="telp"
                        value="{{ old('telp', $cabang->telp) }}">
                    @error('telp')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="5">{{ old('alamat', $cabang->alamat) }}</textarea>
                    @error('alamat')
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
