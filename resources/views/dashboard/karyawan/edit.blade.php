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
        <div class="col-lg-8">
            <form method="POST" action="/dashboard/karyawan/{{ $karyawan->id }}" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Karyawan</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        id="name" value="{{ old('name', $karyawan->name) }}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        id="email" value="{{ old('email', $karyawan->user->email) }}" readonly>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="jk" class="form-label">Jenis Kelamin</label>
                    <select class="form-select form-control" aria-label="Default select example" name="jk">
                        <option value=""></option>
                        @if ('Laki-laki' == old('jk', $karyawan->jk))
                            <option value="Laki-laki" selected>Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        @else
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan" selected>Perempuan</option>
                        @endif
                    </select>
                    @error('jk')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="telp" class="form-label">Telepon</label>
                    <input type="text" name="telp" class="form-control" id="telp"
                        value="{{ old('telp', $karyawan->telp) }}">
                    @error('telp')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="5">{{ old('alamat', $karyawan->alamat) }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Gambar</label>
                    @if ($karyawan->image)
                        <img src="{{ asset('/storage/' . $karyawan->image) }}"
                            class="img-preview img-fluid col-sm-5 d-block">
                    @else
                        <img class="img-preview img-fluid col-sm-5">
                    @endif
                    <input class="form-control @error('image') is-invalid @enderror" type="file" id="image"
                        name="image" onchange="previewImage()" />
                    @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="cabang_id" class="form-label">Cabang</label>
                    <select name="cabang_id" class="form-select form-control @error('cabang_id') is-invalid @enderror">
                        <option selected value=""></option>
                        @foreach ($cabangs as $cabang)
                            @if ($cabang->id == old('cabang_id', $karyawan->cabang_id))
                                <option value="{{ $cabang->id }}" selected>{{ $cabang->name }}</option>
                            @else
                                <option value="{{ $cabang->id }}">{{ $cabang->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('cabang_id')
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
