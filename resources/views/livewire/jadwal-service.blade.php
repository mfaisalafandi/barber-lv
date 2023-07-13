<div class="col-lg-8">
    <h2 class="contact-title">MAKE APPOINTMENT</h2>
    <form class="form-contact contact_form d-inline" action="/appointment/service/{{ $booking_id }}" method="post">
        @csrf
        <div class="col-12 my-3">
            <label for="name" class="form-label">Pilih Service</label>
            <div class="form-group">
                <input wire:model="booking_id" type="hidden" name="booking_id" value="{{ $booking_id }}">
                <select name="service_id" id="" class="form-control">
                    <option value="">-- Service --</option>
                    @foreach ($services as $service)
                        <option value="{{ $service->id }}">{{ $service->name }} | {{ $service->waktu }} menit |
                            Rp.
                            {{ $service->harga }}</option>
                    @endforeach
                </select>
                <button class="btn btn-secondary" wire:click="addService" style="padding: 24px">+</button>
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
                <?php $total = 0;
                $total_harga = 0; ?>
                @foreach ($service_books as $service_book)
                    <?php $total += $service_book->waktu;
                    $total_harga += $service_book->harga; ?>
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
        <p>Total Waktu : {{ $total }} menit</p>
        <p>Rp. {{ $total_harga }}</p>

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
                        <input type="hidden" name="total_harga" value="{{ $total_harga }}">
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
