<?php

namespace App\Http\Livewire;

use App\Models\Booking;
use App\Models\BookingService;
use App\Models\Cabang;
use App\Models\Jadwal;
use App\Models\Karyawan;
use App\Models\Service;
use Carbon\Carbon;
use Livewire\Component;

class Appointment extends Component
{
    public $cabang_id = null, $karyawan_id = null;
    public $service_id = null;
    public $jadwal_full = null;
    public $service_id_arr = [];
    public $service_arr = [];

    public $total_harga = 0;

    public function render()
    {
        $currentDateTime = Carbon::now();
        $currentDate = $currentDateTime->format('Y-m-d');
        $oneDayLater = $currentDateTime->addDay()->format('Y-m-d');

        return view('livewire.appointment', [
            'cabangs' => Cabang::all(),
            'karyawans' => Karyawan::where('cabang_id', $this->cabang_id)->get(),
            'services' => Service::all(),
            'jadwals' => Jadwal::where(function ($query) use ($currentDate, $oneDayLater) {
                $query->where('tanggal', $currentDate)
                    ->orWhere('tanggal', $oneDayLater);
            })->where('karyawan_id', $this->karyawan_id)->get()
        ]);
    }

    public function addService()
    {
        if ($this->service_id) {
            $service = Service::where('id', $this->service_id)->first();
            $this->service_arr = ['id' => $service->id, 'name' => $service->name, 'harga' => $service->harga, 'waktu' => $service->waktu];
            array_push($this->service_id_arr, $this->service_arr);
            $this->total_harga += $service->harga;
            $this->service_id = null;
        }
    }

    public function deleteService($index)
    {
        $this->total_harga -= $this->service_id_arr[$index]['harga'];
        unset($this->service_id_arr[$index]);
    }

    public function store()
    {
        $this->validate([
            'cabang_id' => 'required',
            'karyawan_id' => 'required',
            'jadwal_full' => 'required'
        ]);

        $jamArray = explode("-", $this->jadwal_full);
        $jadwal = Jadwal::create([
            'karyawan_id' => $this->karyawan_id,
            'tanggal' => Carbon::now()->format('Y-m-d'),
            'waktu_awal' => $jamArray[0],
            'waktu_akhir' => $jamArray[1]
        ]);

        $booking = Booking::create([
            'cabang_id' => $this->cabang_id,
            'total_harga' => $this->total_harga,
            'user_id' => auth()->user()->id,
            'karyawan_id' => $this->karyawan_id,
            'jadwal_id' => $jadwal->id
        ]);

        foreach ($this->service_id_arr as $service) {
            // dd($service);
            BookingService::create([
                'booking_id' => $booking->id,
                'service_id' => $service['id'],
                'waktu' => $service['waktu'],
                'harga' => $service['harga']
            ]);
        }

        return redirect('/')->with('success', 'Berhasil Booking');
    }
}
