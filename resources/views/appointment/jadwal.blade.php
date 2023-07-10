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
                        <?php $total = 0; ?>
                        @foreach ($service_books as $service_book)
                            <?php $total += $service_book->waktu; ?>
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
                <p>Total Waktu : {{ $total }}</p>

                <?php
                $start_time = strtotime('08:00');
                $end_time = strtotime('18:00');
                
                // Buat daftar interval waktu yang tersedia
                $jadwal_tersedia = [];
                $current_time = $start_time;
                while ($current_time <= $end_time) {
                    $jadwal_tersedia[] = $current_time;
                    $current_time += $total * 60; // Konversi ke detik
                }
                
                foreach ($jadwals as $jadwal) {
                    $timestamp = strtotime($jadwal->waktu_awal);
                    $end_timestamp = strtotime($jadwal->waktu_akhir); // Konversi ke detik
                
                    // Cek apakah jadwal terpesan bersinggungan dengan interval waktu yang tersedia
                    foreach ($jadwal_tersedia as $index => $interval_timestamp) {
                        $interval_end_timestamp = $interval_timestamp + $total * 60; // Konversi ke detik
                        if (($timestamp >= $interval_timestamp && $timestamp < $interval_end_timestamp) || ($end_timestamp > $interval_timestamp && $end_timestamp <= $interval_end_timestamp)) {
                            unset($jadwal_tersedia[$index]);
                        }
                    }
                }
                
                $jadwal_bisa_dibooking = [];
                foreach ($jadwal_tersedia as $timestamp) {
                    $end_timestamp = $timestamp + $total * 60; // Konversi ke detik
                    if ($end_timestamp <= $end_time) {
                        $jadwal_bisa_dibooking[] = [
                            'start_time' => date('H:i', $timestamp),
                            'end_time' => date('H:i', $end_timestamp),
                        ];
                    }
                }
                
                ?>

                <form class="form-contact contact_form" action="/appointment/jadwal" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-12 my-3">
                            <label for="jadwal" class="form-label">Pilih Jadwal</label>
                            <div class="form-group">
                                <input type="hidden" name="booking_id" value="{{ $booking_id }}">
                                <select name="jadwal" id="jadwal" class="form-control">
                                    <option value="">-- Jadwal --</option>
                                    @foreach ($jadwal_bisa_dibooking as $jadwal)
                                        <option value="{{ $jadwal['start_time'] }}-{{ $jadwal['end_time'] }}">
                                            {{ $jadwal['start_time'] }} - {{ $jadwal['end_time'] }}
                                        </option>
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
