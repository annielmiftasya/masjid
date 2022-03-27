<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uangmasuk extends Model
{
   use HasFactory;
   public $timestamps = false;
   public $table = "uang_masuk";
   protected $fillable = [
      'id',
      'nominal',
      'keterangan',
      'bukti',
      'tanggal',
   ];
}
