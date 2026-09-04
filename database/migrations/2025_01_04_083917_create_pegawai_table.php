<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pegawai', function (Blueprint $table) {
            $table->string('nip', 18)->primary();
            $table->string('nama_lengkap');
            $table->enum('kode_kelamin', ['L', 'P']);
            $table->string('jenjang_jabatan');
            $table->string('pendidikan_terakhir');
            $table->string('seksi')->nullable();
            $table->integer('usia');
            $table->date('tanggal_lahir');
            $table->year('tahun_pensiun');
            $table->string('status_pegawai');
            $table->string('grading')->nullable();
            $table->date('tmt_grading')->nullable();
            $table->string('kode_golongan_ruang');
            $table->date('tmt_pangkat');
            $table->string('mkg_kgb_terakhir');
            $table->date('tmt_kgb');
            $table->date('tmt_awal_penugasan');
            $table->date('tmt_penempatan_seksi')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pegawai');
    }
};