<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingService;
use App\Models\Cabang;
use App\Models\Jadwal;
use App\Models\Karyawan;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function appointment(Request $request)
    {
        $cabang_id = $request->get('cid');

        return view('appointment/index', [
            'services' => Service::all(),
            'karyawans' => Karyawan::where('cabang_id', $cabang_id)->get(),
            'cabangs' => Cabang::all()
        ]);
    }

    public function appointment_make(Request $request)
    {
        $validatedData = $request->validate([
            'karyawan_id' => 'required|numeric',
            'cabang_id' => 'required|numeric'
        ]);

        $validatedData['user_id'] = auth()->user()->id;

        $booking = Booking::create($validatedData);

        return redirect('/appointment/service/' . $booking->id)->with('success', 'Lakukan Pemilihan Service');
    }

    public function appointment_service(Request $request, $id)
    {
        return view('appointment/services_app', [
            'booking_id' => $id,
            'services' => Service::all(),
            'service_books' => BookingService::where('booking_id', $id)->get()
        ]);
    }

    public function appointment_service_make(Request $request, $id)
    {
        $validatedData = $request->validate([
            'service_id' => 'required|numeric',
            'booking_id' => 'required|numeric'
        ]);

        $service = Service::where('id', $validatedData['service_id'])->first();

        $validatedData['waktu'] = $service->waktu;
        $validatedData['harga'] = $service->harga;

        BookingService::create($validatedData);

        return redirect('/appointment/service/' . $validatedData['booking_id'])->with('success', 'Berhasil Menambahkan Service');
    }

    public function appointment_service_delete(Request $request)
    {
        $validatedData = $request->validate([
            'bookingService_id' => 'required|numeric',
            'booking_id' => 'required|numeric'
        ]);

        BookingService::destroy($validatedData['bookingService_id']);

        return redirect('/appointment/service/' . $validatedData['booking_id'])->with('success', 'Service Berhasil Dihapus!!');
    }

    public function appointment_jadwal($id)
    {
        $currentDateTime = Carbon::now();
        $currentDate = $currentDateTime->format('Y-m-d');
        $oneDayLater = $currentDateTime->addDay()->format('Y-m-d');

        return view('appointment/jadwal', [
            'booking_id' => $id,
            'service_books' => BookingService::where('booking_id', $id)->get(),
            'jadwals' => Jadwal::whereDate('tanggal', $currentDate)
                ->orWhereDate('tanggal', $oneDayLater)->get()
        ]);
    }

    public function appointment_jadwal_make(Request $request)
    {
        $validatedData = $request->validate([
            'jadwal' => 'required',
            'booking_id' => 'required|numeric'
        ]);

        $jamArray = explode("-", $validatedData['jadwal']);

        $validatedData['waktu_awal'] = $jamArray[0];
        $validatedData['waktu_akhir'] = $jamArray[1];
        $validatedData['tanggal'] = Carbon::now()->format('Y-m-d');

        $booking = Booking::where('id', $validatedData['booking_id'])->first();

        $validatedData['karyawan_id'] = $booking->karyawan_id;

        $jadwal = Jadwal::create($validatedData);

        Booking::where('id', $validatedData['booking_id'])->update(['jadwal_id' => $jadwal->id]);

        return redirect('/')->with('success', 'Pembookingan Berhasil Dilakukan!!');
    }
}
