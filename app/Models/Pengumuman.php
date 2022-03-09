<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = "pengumuman";
    protected $fillable = [
        'id',
        'judul',
        'isi',
        'foto',
        'tanggal',
    ];
}
