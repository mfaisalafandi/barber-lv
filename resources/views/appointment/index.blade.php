@extends('layouts.main')

@section('container')
    <!--? slider Area Start-->
    <div class="slider-area position-relative fix">
        <div class="slider-active">
            <!-- Single Slider -->
            <div class="single-slider slider-height d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-8 col-lg-9 col-md-11 col-sm-10">
                            <div class="hero__caption">
                                <span data-animation="fadeInUp" data-delay="0.2s">with patrick potter</span>
                                <h1 data-animation="fadeInUp" data-delay="0.5s">Our Hair Style make your look
                                    elegance</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Single Slider -->
            <div class="single-slider slider-height d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-8 col-lg-9 col-md-11 col-sm-10">
                            <div class="hero__caption">
                                <span data-animation="fadeInUp" data-delay="0.2s">with patrick potter</span>
                                <h1 data-animation="fadeInUp" data-delay="0.5s">Our Hair Style make your look
                                    elegance</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- stroke Text -->
        <div class="stock-text">
            <h2>Get More confident</h2>
            <h2>Get More confident</h2>
        </div>
        <!-- Arrow -->
        <div class="thumb-content-box">
            <div class="thumb-content">
                <h3>make an appointment now</h3>
                <a href="#make_appointment"> <i class="fas fa-long-arrow-alt-right"></i></a>
            </div>
        </div>
    </div>
    <!-- slider Area End-->

    <div class="container">
        <div class="row my-5">
            <div class="col-lg-2"></div>
            <div class="col-lg-8">
                <h2 class="contact-title">MAKE APPOINTMENT</h2>
                <form class="form-contact contact_form" action="/appointment" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-12 my-3">
                            <label for="karyawan_id" class="form-label">Pilih Karyawan</label>
                            <div class="form-group">
                                <input type="hidden" name="cabang_id" value="{{ $_GET['cid'] }}">
                                <select name="karyawan_id" id="karyawan_id" class="form-control">
                                    <option value="">-- Karyawan --</option>
                                    @foreach ($karyawans as $karyawan)
                                        <option value="{{ $karyawan->id }}">{{ $karyawan->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" class="button button-contactForm boxed-btn">Buat Janji</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

{{-- <div class="col-12">
                            <div class="form-group">
                                <input class="form-control" name="subject" id="subject" type="text"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Subject'"
                                    placeholder="Enter Subject">
                            </div>
                        </div> --}}
