<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingService;
use Illuminate\Http\Request;

class DashboardKasirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.kasir.index', [
            'kasirs' => Booking::where('status_proses', 1)->where('status_lunas', null)->get()
        ]);
    }

    public function bayar($id)
    {
        return view('dashboard.kasir.proses', [
            'booking' => Booking::where('id', $id)->first()
        ]);
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
        $validatedData = $request->validate([
            'bayar' => 'required',
            'total_harga' => 'required',
            'booking_id' => 'required'
        ]);

        if ($validatedData['bayar'] <= $validatedData['total_harga']) {
            return redirect('/dashboard/kasir/' . $validatedData['booking_id'])->with('error', 'Pembayaran Kurang');
        }

        $kembalian = $validatedData['bayar'] - $validatedData['total_harga'];

        Booking::where('id', $validatedData['booking_id'])->update([
            'status_lunas' => 1,
            'bayar_offline' => $validatedData['bayar'],
            'kembalian' => $kembalian
        ]);

        return redirect('/dashboard/kasir')->with('success', 'Pembayaran Berhasil Dilakukan');
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
        return view('dashboard.kasir.proses', [
            'booking' => $booking
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
