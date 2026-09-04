<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('monitorings', function (Blueprint $table) {
            $table->id();
            $table->string('nip', 18);
            $table->enum('jenis_info', ['Grading', 'Pangkat', 'KGB']);
            $table->date('tmt_berikutnya');
            $table->enum('status_tindak_lanjut', ['Belum', 'Sudah', 'Tidak'])->default('Belum');
            $table->text('keterangan')->nullable();
            $table->text('catatan')->nullable(); // Kolom catatan sudah ditambahkan
            $table->timestamps();
            
            // Relasi ke tabel pegawai
            $table->foreign('nip')->references('nip')->on('pegawai')
                  ->onDelete('cascade')->onUpdate('cascade');

            // Indeks untuk mempercepat query
            $table->index(['nip', 'jenis_info']);
            $table->index('tmt_berikutnya');
        });
    }

    public function down()
    {
        Schema::dropIfExists('monitorings'); // Nama tabel harus konsisten
    }
};
