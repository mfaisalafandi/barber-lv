@extends('layouts.main')

@section('container')
    <!--? slider Area Start-->
    <div class="slider-area position-relative fix">
        <div class="slider-active">
            <!-- Single Slider -->
            <div class="single-slider slider-height d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 login-form mx-auto">
                            <h1 class="text-white fs-1">Registrasi</h1>
                            <form class="text-white" action="/registrasi" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label class="text-white">Nama Lengkap</label>
                                    <input type="text"
                                        class="form-control form-control-lg @error('name') is-invalid @enderror"
                                        placeholder="Nama Lengkap" name="name" value="{{ old('name') }}">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <label class="text-white">Jenis Kelamin</label> <br />
                                <div class="form-group form-check">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jk" id="jk"
                                            value="Laki-laki" />
                                        <label class="form-check-label" for="jk">
                                            Laki-laki
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jk" id="jk"
                                            value="Perempuan" />
                                        <label class="form-check-label" for="jk">
                                            Perempuan
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="text-white">No. Telepon</label>
                                    <input type="text"
                                        class="form-control form-control-lg @error('telp') is-invalid @enderror"
                                        placeholder="No. Telepon" name="telp" value="{{ old('telp') }}">
                                    @error('telp')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="text-white">Alamat</label>
                                    <textarea name="alamat" id="alamat" class="form-control form-control-lg @error('alamat') is-invalid @enderror"
                                        cols="10" rows="5" placeholder="Alamat">{{ old('alamat') }}</textarea>
                                    @error('alamat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="text-white">Email</label>
                                    <input type="email"
                                        class="form-control form-control-lg @error('email') is-invalid @enderror"
                                        placeholder="Email" name="email" value="{{ old('email') }}">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="text-white">Password</label>
                                    <input type="password"
                                        class="form-control form-control-lg @error('password') is-invalid @enderror"
                                        placeholder="Password" name="password" value="{{ old('password') }}">
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <button type="submit" name="btn-submit" class="btn btn-success btn-flat"
                                    style="margin-bottom: 3%;">Sign Up</button>
                                <div class="register-link m-t-15 text-center">
                                    <p class="text-white">Have account ? <a href="/login"> Sign In Here</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider Area End-->
@endsection
