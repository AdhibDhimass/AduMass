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
        Schema::create('tanggapans', function (Blueprint $table) {
            $table->id(); // Kolom id
            $table->timestamp('tgl_tanggapan');
            $table->text('tanggapan');
            $table->unsignedBigInteger('user_id'); // Kolom user_id untuk foreign key
            $table->unsignedBigInteger('pengaduan_id'); // Kolom pengaduan_id untuk foreign key
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('pengaduan_id')->references('id')->on('pengaduans');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tanggapans');
    }
};
