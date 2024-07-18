<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
  use HasFactory;

  protected $fillable = [
    'user_id',
    'nama',
    'jenis_kelamin',
    'tanggal_lahir',
    'agama',
    'email',
    'nomor_telepon',
    'foto',
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}