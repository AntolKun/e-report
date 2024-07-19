<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
  use HasFactory;

  protected $table = 'kelas';

  protected $fillable = [
    'nama_kelas',
    'tahun_id',
    'guru_id',
  ];

  // Relasi dengan model TahunAjaran
  public function tahunAjaran()
  {
    return $this->belongsTo(TahunAjaran::class, 'tahun_id');
  }

  // Relasi dengan model Guru
  public function guru()
  {
    return $this->belongsTo(Guru::class, 'guru_id');
  }
}