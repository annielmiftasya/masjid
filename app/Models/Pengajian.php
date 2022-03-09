<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajian extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = "pengajian";
    protected $fillable = [
        'id',
        'judul',
        'foto',
        'deskripsi',
    ];
}
