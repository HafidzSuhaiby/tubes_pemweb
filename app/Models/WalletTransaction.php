<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletTransaction extends Model
{
    use HasFactory;

    // Ini PENTING agar kita bisa melakukan create() data secara langsung
    protected $guarded = ['id'];

    // Relasi ke User (opsional, tapi bagus untuk nanti)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}