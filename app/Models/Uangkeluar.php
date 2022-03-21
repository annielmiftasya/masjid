<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uangkeluar extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = "uang_keluar";
    protected $fillable = [
        'id',
        'nominal',
        'keterangan',
        'bukti',
        'tanggal',
    ];
}
