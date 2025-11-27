<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const STATUS_PENDING   = 'pending';
    const STATUS_DITERIMA  = 'diterima';
    const STATUS_DIPROSES  = 'diproses';
    const STATUS_SELESAI   = 'selesai';
    const STATUS_DIBATALKAN = 'dibatalkan';

    protected $fillable = [
        'user_id',
        'service_id',
        'provider_id',
        'booking_date',
        'booking_time',
        'alamat',
        'catatan',
        'status',
        'payment_status',
        'payment_method',
    ];

    // Relasi
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function provider()
    {
        return $this->belongsTo(User::class, 'provider_id');
    }

    public function service()
    {
        return $this->belongsTo(ServiceRegistration::class, 'service_id');
    }

    // Helper untuk label status (kalau mau beda tampilan)
    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            self::STATUS_PENDING    => 'Pending',
            self::STATUS_DITERIMA   => 'Diterima',
            self::STATUS_DIPROSES   => 'Diproses',
            self::STATUS_SELESAI    => 'Selesai',
            self::STATUS_DIBATALKAN => 'Dibatalkan',
            default                 => ucfirst($this->status),
        };
    }
}
