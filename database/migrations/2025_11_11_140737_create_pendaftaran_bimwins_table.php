<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendaftaranBimwinsTable extends Migration
{
    public function up()
    {
        Schema::create('pendaftaran_bimwins', function (Blueprint $table) {
            $table->id();

            // Relasi ke User (akun yang mendaftar)
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Relasi ke Jadwal yang dipilih
            $table->unsignedBigInteger('jadwal_id');
            $table->foreign('jadwal_id')->references('id')->on('jadwal_bimwins');

            // --- Data Calon Suami ---
            $table->string('nama_calon_suami');
            $table->string('nik_calon_suami', 16);
            $table->string('tempat_lahir_suami');
            $table->date('tanggal_lahir_suami');
            $table->string('pekerjaan_suami');
            $table->text('alamat_suami');
            $table->string('nomor_hp_suami', 15);
            $table->string('file_ktp_suami')->nullable(); // Path untuk file upload KTP

            // --- Data Calon Istri ---
            $table->string('nama_calon_istri');
            $table->string('nik_calon_istri', 16);
            $table->string('tempat_lahir_istri');
            $table->date('tanggal_lahir_istri');
            $table->string('pekerjaan_istri');
            $table->text('alamat_istri');
            $table->string('nomor_hp_istri', 15);
            $table->string('file_ktp_istri')->nullable(); // Path untuk file upload KTP

            // --- Status Verifikasi (untuk Admin) ---
            $table->enum('status_verifikasi', ['pending', 'disetujui', 'ditolak'])->default('pending');
            $table->text('catatan_verifikasi')->nullable(); // Jika ditolak, apa alasannya

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pendaftaran_bimwins');
    }
}
