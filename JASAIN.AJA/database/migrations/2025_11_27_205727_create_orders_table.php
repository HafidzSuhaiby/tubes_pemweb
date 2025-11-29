<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            // siapa yang pesan & jasa apa
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('service_id')->constrained('service_registrations')->onDelete('cascade');
            $table->foreignId('provider_id')->constrained('users')->onDelete('cascade');

            // detail booking
            $table->date('booking_date');
            $table->time('booking_time');
            $table->text('alamat');
            $table->text('catatan')->nullable();

            // status pengerjaan (dipantau penyedia & admin)
            $table->string('status')->default('pending');
            // optional label kalau mau
            // $table->string('status_label')->nullable();

            // ====== KOLOM PEMBAYARAN (UNTUK QR) ======
            // unpaid / waiting / paid / failed / cancelled
            $table->string('payment_status')->default('unpaid');

            // metode pembayaran (dana/gopay/ovo/qris, dll)
            $table->string('payment_method')->nullable();

            // token unik yang nanti dimasukkan ke QR
            $table->string('payment_token')->nullable()->unique();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
