<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['karyawan', 'booking'];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
