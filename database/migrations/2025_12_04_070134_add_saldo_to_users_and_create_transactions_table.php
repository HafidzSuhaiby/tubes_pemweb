<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Menambahkan kolom saldo ke tabel users
        Schema::table('users', function (Blueprint $table) {
            // Default 0, tipe BigInteger agar muat angka besar
            $table->bigInteger('saldo')->default(0)->after('password');
            
            // Info bank untuk withdrawal (opsional, bisa diisi nanti)
            $table->string('nama_bank')->nullable()->after('saldo');
            $table->string('nomor_rekening')->nullable()->after('nama_bank');
            $table->string('atas_nama_rekening')->nullable()->after('nomor_rekening');
        });

        // 2. Membuat tabel riwayat transaksi (mutasi rekening)
        Schema::create('wallet_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Tipe: 'credit' (uang masuk), 'debit' (uang keluar/withdraw)
            $table->enum('type', ['credit', 'debit']); 
            
            $table->bigInteger('amount'); // Jumlah uang
            $table->string('description'); // Contoh: "Pencairan Order #123"
            
            // Relasi opsional ke order (biar tau uang ini dari pesanan mana)
            // nullable() karena kalau withdraw manual tidak ada order_id nya
            $table->unsignedBigInteger('order_id')->nullable(); 
            
            $table->timestamps();
        });

        // 3. Menambahkan status pencairan dana di tabel orders
        Schema::table('orders', function (Blueprint $table) {
            $table->boolean('is_funds_released')->default(false)->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('is_funds_released');
        });

        Schema::dropIfExists('wallet_transactions');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['saldo', 'nama_bank', 'nomor_rekening', 'atas_nama_rekening']);
        });
    }
};