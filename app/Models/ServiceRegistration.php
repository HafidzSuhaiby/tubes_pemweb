<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_jasa',
        'kategori',
        'deskripsi',
        'pengalaman',
        'harga_mulai',
        'kota',
        'area_layanan',
        'hari_kerja',
        'jam_operasional',
        'ktp_path',
        'foto_jasa_paths',
        'portofolio_paths',
        'setuju',
        'status',
    ];

    protected $casts = [
        'foto_jasa_paths' => 'array',
        'portofolio_paths' => 'array',
        'setuju'          => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getKategoriLabelAttribute()
    {
        $map = [
            'cleaning'   => 'Cleaning Service',
            'teknisi'    => 'Teknisi / Perbaikan',
            'babysitter' => 'Babysitter',
            'homecare'   => 'Home Care',
            'lainnya'    => 'Lainnya',
        ];

        return $map[$this->kategori] ?? $this->kategori ?? '-';
    }
}
