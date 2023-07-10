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
            <form method="POST" action="/dashboard/service/{{ $service->id }}" enctype="multipart/form-data">
                @method('put')
                @csrf
                <input type="hidden" name="oldImage" value="{{ $service->image }}" />
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Service</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        id="name" value="{{ old('name', $service->name) }}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga Rp.</label>
                    <input type="number" name="harga" class="form-control @error('harga') is-invalid @enderror"
                        id="harga" value="{{ old('harga', $service->harga) }}">
                    @error('harga')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="waktu" class="form-label">Waktu (Menit)</label>
                    <input type="number" name="waktu" class="form-control" id="waktu"
                        value="{{ old('waktu', $service->waktu) }}">
                    @error('waktu')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Gambar</label>
                    @if ($service->image)
                        <img src="{{ asset('/storage/' . $service->image) }}"
                            class="img-preview img-fluid col-sm-5 d-block">
                    @else
                        <img class="img-preview img-fluid col-sm-5">
                    @endif
                    <img class="img-preview img-fluid mb-3 col-sm-5">
                    <input class="form-control @error('image') is-invalid @enderror" type="file" id="image"
                        name="image" onchange="previewImage()" />
                    @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    @error('deskripsi')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <input id="deskripsi" type="hidden" name="deskripsi"
                        value="{{ old('deskripsi', $service->deskripsi) }}">
                    <trix-editor input="deskripsi"></trix-editor>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
