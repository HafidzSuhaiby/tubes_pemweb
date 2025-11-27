<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('username')->nullable();
            $table->string('email')->unique();

            // Telepon & alamat
            $table->string('telepon')->nullable();
            $table->text('alamat')->nullable();

            // Foto profil baru
            $table->string('photo_profile')->nullable();

            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            // role_id jika roles table tersedia
            if (Schema::hasTable('roles')) {
                $table->foreignId('role_id')
                      ->nullable()
                      ->constrained()
                      ->nullOnDelete();
            }

            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
