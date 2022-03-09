<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalSholat extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = "sholat";
    protected $fillable = [
        'id',
        'tanggal',
        'imsyak',
        'shubuh',
        'terbit',
        'dhuha',
        'dzuhur',
        'ashr',
        'magrib',
        'isya'
    ];
}
