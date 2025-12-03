<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'service_id',
        'provider_id',
        'booking_date',
        'booking_time',
        'alamat',
        'catatan',
        'status',

        // pembayaran
        'payment_status',
        'payment_method',
        'payment_token',
    ];

    // relasi (kalau belum ada)
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

    // accessor label status (biar tampilan rapi)
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'pending'    => 'Pending',
            'diterima'   => 'Diterima',
            'diproses'   => 'Diproses',
            'selesai'    => 'Selesai',
            'dibatalkan' => 'Dibatalkan',
            default      => ucfirst($this->status),
        };
    }
}
