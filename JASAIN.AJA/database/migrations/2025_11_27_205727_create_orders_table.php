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

            // siapa yang memesan
            $table->unsignedBigInteger('user_id');

            // jasa yang dipesan (service_registrations.id)
            $table->unsignedBigInteger('service_id');

            // pemilik / penyedia jasa (user_id dari service_registrations)
            $table->unsignedBigInteger('provider_id');

            // detail booking
            $table->date('booking_date');
            $table->time('booking_time');
            $table->text('alamat');
            $table->text('catatan')->nullable();

            // status: pending, diterima, diproses, selesai, dibatalkan
            $table->string('status', 20)->default('pending');

            // nanti untuk pembayaran, sementara biarkan saja
            $table->string('payment_status', 20)->default('belum_dibayar');
            $table->string('payment_method', 50)->nullable();

            $table->timestamps();

            // foreign key (opsional, tapi bagus kalau ada)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('service_registrations')->onDelete('cascade');
            $table->foreign('provider_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
