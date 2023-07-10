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
                            @if (session()->has('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if (session()->has('loginError'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('loginError') }}
                                </div>
                            @endif
                            <h1 class="text-white fs-1">Login</h1>
                            <form class="text-white" action="/login" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label class="text-white">Email</label>
                                    <input type="email" class="form-control form-control-lg" placeholder="Email"
                                        name="email" value="{{ old('email') }}">
                                </div>
                                <div class="form-group">
                                    <label class="text-white">Password</label>
                                    <input type="password" class="form-control form-control-lg" placeholder="Password"
                                        name="password" value="{{ old('password') }}">
                                </div>
                                <button type="submit" name="btn-submit" class="btn btn-success btn-flat"
                                    style="margin-bottom: 3%;">Sign in</button>
                                <div class="register-link m-t-15 text-center">
                                    <p class="text-white">Don't have account ? <a href="/registrasi"> Sign Up Here</a>
                                    </p>
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
