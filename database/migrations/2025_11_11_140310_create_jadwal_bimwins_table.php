<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalBimwinsTable extends Migration
{
    public function up()
    {
        Schema::create('jadwal_bimwins', function (Blueprint $table) {
            $table->id();
            $table->string('nama_angkatan'); // Misal: "Angkatan I - November 2025"
            $table->date('tanggal_pelaksanaan');
            $table->string('waktu_pelaksanaan'); // Misal: "08:00 - 12:00 WIB"
            $table->string('lokasi'); // Misal: "Aula KUA Marga Punduh"
            $table->integer('kuota');
            $table->enum('status', ['dibuka', 'ditutup', 'penuh', 'selesai'])->default('dibuka');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jadwal_bimwins');
    }
}
