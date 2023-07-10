<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['cabang', 'user'];

    public function cabang()
    {
        return $this->belongsTo(Cabang::class);
    }
    public function user()
    {
        return $this->belongsTo(user::class);
    }
}
