<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
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
