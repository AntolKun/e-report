<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProyekSiswa extends Model
{
  use HasFactory;

  protected $table = 'proyek_siswa';

  protected $fillable = [
    'proyek_id',
    'siswa_id',
    'file_path',
    'file_link',
    'status',
  ];

  public function proyek()
  {
    return $this->belongsTo(Proyek::class);
  }

  public function siswa()
  {
    return $this->belongsTo(Siswa::class);
  }

  public function proyekSiswa()
  {
    return $this->hasMany(ProyekSiswa::class);
  }
}
