<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_registrations', function (Blueprint $table) {
            $table->id();

            // Relasi ke users (informasi pribadi diambil dari user yang login)
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            // ============================
            //  STEP 1: INFORMASI JASA
            // ============================
            $table->string('nama_jasa');                    // nama_jasa
            $table->string('kategori')->nullable();         // kategori
            $table->text('deskripsi')->nullable();          // deskripsi
            $table->unsignedTinyInteger('pengalaman')->nullable();  // pengalaman (tahun)
            $table->unsignedBigInteger('harga_mulai')->nullable();  // harga_mulai

            // ============================
            //  STEP 2: LOKASI LAYANAN
            // ============================
            $table->string('kota')->nullable();             // kota
            $table->text('area_layanan')->nullable();       // area_layanan
            $table->string('hari_kerja')->nullable();       // hari kerja (Senin-Sabtu)
            $table->string('jam_operasional')->nullable();  // jam_operasional

            // ============================
            //  STEP 3: VERIFIKASI
            // ============================
            $table->string('ktp_path')->nullable();             // path upload KTP
            $table->json('portofolio_paths')->nullable();       // ⬅⬅ plural & json
            $table->json('foto_jasa_paths')->nullable();        // path[] foto jasa (multiple)
            $table->boolean('setuju')->default(false);          // centang syarat & ketentuan

            // Status pendaftaran (buat approval admin)
            $table->enum('status', ['pending', 'approved', 'rejected'])
                  ->default('pending');
            $table->boolean('is_active')->default(true); 

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_registrations');
    }
};
