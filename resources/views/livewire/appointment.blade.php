<div class="col-lg-8">
    <h2 class="contact-title">MAKE APPOINTMENT</h2>
    {{-- <form class="form-contact contact_form" action="/appointment" method="post"> --}}
    <form class="form-contact contact_form" wire:submit.prevent="store">
        @csrf
        <div class="row">
            <div class="col-12 my-3">
                <label for="karyawan_id" class="form-label">Pilih Cabang</label>
                <div class="form-group" wire:ignore>
                    <select wire:model="cabang_id" name="cabang_id" id="cabang_id"
                        class="form-control @error('cabang_id') is-invalid @enderror">
                        <option hidden>-- Cabang --</option>
                        @foreach ($cabangs as $cabang)
                            <option value="{{ $cabang->id }}">
                                {{ $cabang->name }} | {{ $cabang->alamat }}
                            </option>
                        @endforeach
                    </select>
                    @error('cabang_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-12 my-3">
                <label for="karyawan_id" class="form-label">Pilih Karyawan</label>
                <div class="form-group">
                    <select name="karyawan_id" id="karyawan_id"
                        class="form-control @error('karyawan_id') is-invalid @enderror" wire:model="karyawan_id">
                        <option hidden>-- Karyawan --</option>
                        @foreach ($karyawans as $karyawan)
                            <option value="{{ $karyawan->id }}">{{ $karyawan->name }}</option>
                        @endforeach
                    </select>
                    @error('karyawan_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            @if ($karyawan_id)
                <div class="col-12 my-3">
                    <label for="name" class="form-label">Pilih Service</label>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-6">
                                <select name="service_id" id="service_id" class="form-control" wire:model="service_id">
                                    <option hidden>-- Service --</option>
                                    @foreach ($services as $service)
                                        <option value="{{ $service->id }}">
                                            {{ $service->name }} | {{ $service->waktu }}
                                            menit | Rp. {{ $service->harga }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <button wire:click="addService" type="button" class="btn btn-secondary"
                                    style="padding: 24px">+</button>
                            </div>
                            {{-- {{ $service_id }} ||
                            <br><br>
                            {{ var_dump($service_arr) }} |||
                            <br><br>
                            {{ var_dump($service_id_arr) }} --}}

                            <div class="col-lg-12 my-3">
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
                                        @foreach ($service_id_arr as $index => $service)
                                            <?php
                                            $total += $service['waktu'];
                                            $total_harga += $service['harga'];
                                            ?>
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $service['name'] }}</td>
                                                <td>{{ $service['waktu'] }} menit</td>
                                                <td>Rp. {{ $service['harga'] }}</td>
                                                <td>
                                                    <button wire:click="deleteService({{ $index }})"
                                                        type="button" class="btn btn-danger border-0">Delete</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            @if ($total > 0)
                                <div class="col-lg-12">
                                    <p style="font-size: 13px">Total Waktu : {{ $total }} menit</p>
                                    <p style="font-size: 13px">Total Harga : Rp. {{ $total_harga }}</p>
                                </div>
                                <div class="col-lg-12 my-3">
                                    <?php
                                    $start_time = strtotime('08:00');
                                    $end_time = strtotime('18:00');
                                    
                                    // Buat daftar interval waktu yang tersedia
                                    $jadwal_tersedia = [];
                                    $current_time = $start_time;
                                    while ($current_time <= $end_time) {
                                        // $jadwal_tersedia[] = $current_time;
                                        array_push($jadwal_tersedia, $current_time);
                                        $current_time += $total * 60; // Konversi ke detik
                                    }
                                    
                                    foreach ($jadwals as $jadwal) {
                                        $timestamp = strtotime($jadwal->waktu_awal);
                                        $end_timestamp = strtotime($jadwal->waktu_akhir); // Konversi ke detik
                                    
                                        // Cek apakah jadwal terpesan bersinggungan dengan interval waktu yang tersedia
                                        foreach ($jadwal_tersedia as $index => $interval_timestamp) {
                                            $interval_end_timestamp = $interval_timestamp + $total * 60; // Konversi ke detik
                                            if (($timestamp >= $interval_timestamp && $timestamp < $interval_end_timestamp) || ($end_timestamp > $interval_timestamp && $end_timestamp <= $interval_end_timestamp) || ($interval_timestamp >= $timestamp && $interval_end_timestamp < $end_timestamp)) {
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

                                    <label for="jadwal" class="form-label">Pilih Jadwal</label>
                                    <div class="form-group">
                                        <select name="jadwal_full" id="jadwal_full"
                                            class="form-control @error('jadwal_full') is-invalid @enderror"
                                            wire:model="jadwal_full">
                                            <option hidden>-- Jadwal --</option>
                                            @foreach ($jadwal_bisa_dibooking as $jadwal)
                                                <option value="{{ $jadwal['start_time'] }}-{{ $jadwal['end_time'] }}">
                                                    {{ $jadwal['start_time'] }} -
                                                    {{ $jadwal['end_time'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('jadwal_full')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    {{-- {{ $jadwal_full }} --}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                {{-- <input type="text" name="total_harga" wire:model="total_harga" wire:dirty
                    value="{{ $total_harga }}"> --}}
            @endif

        </div>
        <div class="form-group mt-3">
            <button type="submit" class="button button-contactForm boxed-btn">Buat Janji</button>
        </div>
    </form>

</div>
