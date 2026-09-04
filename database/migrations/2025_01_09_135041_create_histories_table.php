<?php
// File: database/migrations/2025_01_09_create_histories_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->string('nip', 18);
            $table->enum('jenis_info', ['Grading', 'Pangkat', 'KGB']);
            $table->date('tmt');
            $table->enum('status_tindak_lanjut', ['Belum', 'Sudah', 'Tidak']);
            $table->text('catatan')->nullable();
            $table->timestamp('tanggal_tindak_lanjut');
            $table->timestamps();

            $table->foreign('nip')
                ->references('nip')
                ->on('pegawai')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('histories');
    }
};