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
                <form class="form-contact contact_form" action="/appointment/service/{{ $booking_id }}" method="post">
                    @csrf
                    <div class="col-12 my-3">
                        <label for="name" class="form-label">Pilih Service</label>
                        <div class="form-group">
                            <input type="hidden" name="booking_id" value="{{ $booking_id }}">
                            <select name="service_id" id="" class="form-control">
                                <option value="">-- Service --</option>
                                @foreach ($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->name }} | {{ $service->waktu }} menit |
                                        Rp.
                                        {{ $service->harga }}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-secondary" style="padding: 24px">+</button>
                        </div>
                    </div>
                </form>
                <div class="col-12 my-3">
                    <table id="bootstrap-data-table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Service</th>
                                <th>Waktu</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($service_books as $service_book)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $service_book->service->name }}</td>
                                    <td>{{ $service_book->waktu }} menit</td>
                                    <td>Rp. {{ $service_book->harga }}</td>
                                    <td>
                                        <form action="/appointment/service/{{ $service_book->id }}" method="post"
                                            class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <input type="hidden" name="bookingService_id" value="{{ $service_book->id }}">
                                            <input type="hidden" name="booking_id" value="{{ $booking_id }}">
                                            <button class="btn btn-danger border-0"
                                                onclick="return confirm('Apakah yakin?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="form-group mt-5">
                        <a href="/appointment/jadwal/{{ $booking_id }}" class="button button-contactForm boxed-btn">Pilih
                            Jadwal</a>
                    </div>
                </div>


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
