<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class ReportPelangganController extends Controller
{
    public function index()
    {
        // return Booking::select('user_id', Booking::raw('SUM(total_harga) as all_harga', Pelanggan::where('user_id', 'user_id'))->groupBy('user_id')->get();
        // return Booking::select('bookings.user_id', Booking::raw('SUM(total_harga) as all_harga'))
        //     ->join('pelanggans', 'pelanggans.user_id', '=', 'bookings.user_id')
        //     ->with('pelanggans')
        //     ->groupBy('user_id')
        //     ->get();

        return view('dashboard.report.pelanggan.index', [
            'pelanggans' => Booking::select('bookings.user_id', Booking::raw('COUNT(*) as total_booking'), Booking::raw('SUM(total_harga) as all_harga'))
                ->join('users', 'users.id', '=', 'bookings.user_id')
                ->with('user.pelanggan')
                ->groupBy('bookings.user_id')
                ->get()
        ]);
    }
}
