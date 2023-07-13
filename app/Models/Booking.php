<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['cabang', 'user', 'karyawan', 'bookingService', 'jadwal'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }
    public function cabang()
    {
        return $this->belongsTo(Cabang::class);
    }
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
    public function bookingService()
    {
        return $this->hasMany(BookingService::class);
    }
}
