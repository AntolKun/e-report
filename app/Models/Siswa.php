<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
  use HasFactory;

  protected $fillable = [
    'user_id', 'nama', 'nisn', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'agama', 'email', 'nomor_telepon', 'foto'
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
