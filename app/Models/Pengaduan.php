<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class pengaduan extends Model
{
    use HasFactory;

    protected $fillable = [
    'tgl_pengaduan',
    'judul',
     'isi_laporan',
      'foto',
       'status',
        'nik',
    ];

    public function user()
{
    return $this->belongsTo(User::class, 'nik', 'nik', 'user_id');
}

// Di model Pengaduan
public function tanggapan()
{
    return $this->hasOne(Tanggapan::class);
}


}
