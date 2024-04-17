<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pembayaran_iyurans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('jenis_iyuran_id');
            $table->date('tanggal_pembayaran');
            $table->string('keterangan')->nullable();
            $table->timestamps();

            // Menetapkan foreign key ke kolom 'id' pada tabel 'users'
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // // Menetapkan foreign key ke kolom 'id' pada tabel 'jenis_iyuran'
            $table->foreign('jenis_iyuran_id')->references('id')->on('jenis_iyurans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran_iyurans');
    }
};
