<?php

namespace App\Http\Livewire;

use App\Models\Booking;
use App\Models\BookingService;
use App\Models\Jadwal;
use App\Models\Service;
use Carbon\Carbon;
use Livewire\Component;

class JadwalService extends Component
{
    public $booking_id;

    public function render()
    {
        $currentDateTime = Carbon::now();
        $currentDate = $currentDateTime->format('Y-m-d');
        $oneDayLater = $currentDateTime->addDay()->format('Y-m-d');

        $booking = Booking::where('id', $this->booking_id)->first();

        return view('livewire.jadwal-service', [
            'services' => Service::all(),
            'service_books' => BookingService::where('booking_id', $this->booking_id)->get(),
            'jadwals' => Jadwal::where(function ($query) use ($currentDate, $oneDayLater) {
                $query->where('tanggal', $currentDate)
                    ->orWhere('tanggal', $oneDayLater);
            })->where('karyawan_id', $booking->karyawan_id)->get()
        ]);
    }
}
