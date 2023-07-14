<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingService;
use App\Models\Jadwal;
use App\Models\Karyawan;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->level == 1) {
            $karyawan = Karyawan::where('user_id', auth()->user()->id)->first();
            return view('dashboard.booking.index', [
                'bookings' => Booking::where('status_proses', null)
                    ->where('jadwal_id', '<>', null)
                    ->where('karyawan_id', $karyawan->id)->get()
            ]);
        } else if (auth()->user()->level == 2) {
            return view('dashboard.booking.index', [
                'bookings' => Booking::where('status_proses', null)
                    ->where('jadwal_id', '<>', null)->get()
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        return view('dashboard.booking.proses', [
            'booking' => $booking,
            'bookingServices' => BookingService::where('booking_id', $booking->id)->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        Booking::where('id', $booking->id)->update(['status_proses' => 1]);
        return redirect('/dashboard/booking')->with('success', 'Pelayanan Berhasil Dilakukan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        if ($booking->image) {
            Storage::delete($booking->image);
        }
        $jadwal_id = $booking->jadwal_id;
        BookingService::destroy($booking->booking_id);
        Booking::destroy($booking->id);
        Jadwal::destroy($jadwal_id);
        return redirect('/dashboard/booking')->with('success', 'Booking Berhasil Dihapus!!');
    }
}
