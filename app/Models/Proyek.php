<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyek extends Model
{
  use HasFactory;

  protected $table = 'proyek';

  protected $fillable = [
    'tema_proyek',
    'dimensi_id',
    'elemen_1',
    'sub_elemen',
    'tanggal_deadline',
    'kelas_id',
    'guru_id',
  ];

  public function dimensi()
  {
    return $this->belongsTo(Dimensi::class);
  }

  public function kelas()
  {
    return $this->belongsTo(Kelas::class);
  }

  public function guru()
  {
    return $this->belongsTo(Guru::class);
  }

  public function siswa()
  {
    return $this->belongsToMany(Siswa::class, 'proyek_siswa')
    ->withPivot('file_path', 'file_link', 'status')
    ->withTimestamps();
  }

  public function proyekSiswa()
  {
    return $this->hasMany(ProyekSiswa::class);
  }

}
