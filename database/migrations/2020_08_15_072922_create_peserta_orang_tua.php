<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesertaOrangTua extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peserta_orang_tua', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->id();
            $table->unsignedBigInteger('peserta_id')->nullable();
            $table->string('ayah')->nullable();
            $table->string('ayah_alamat')->nullable();
            $table->string('ayah_rt')->nullable();
            $table->string('ayah_rw')->nullable();
            $table->string('ayah_kelurahan')->nullable();
            $table->string('ayah_kecamatan')->nullable();
            $table->string('ayah_kabupaten')->nullable();
            $table->string('ayah_provinsi')->nullable();
            $table->string('ayah_pekerjaan')->nullable();
            $table->string('ayah_telepon')->nullable();
            $table->string('ayah_hp')->nullable();
            $table->string('ayah_keadaan')->nullable();
            $table->string('ibu')->nullable();
            $table->string('ibu_alamat')->nullable();
            $table->string('ibu_rt')->nullable();
            $table->string('ibu_rw')->nullable();
            $table->string('ibu_kelurahan')->nullable();
            $table->string('ibu_kecamatan')->nullable();
            $table->string('ibu_kabupaten')->nullable();
            $table->string('ibu_provinsi')->nullable();
            $table->string('ibu_pekerjaan')->nullable();
            $table->string('ibu_telepon')->nullable();
            $table->string('ibu_hp')->nullable();
            $table->string('ibu_keadaan')->nullable();
            $table->timestamps();

            $table->foreign('peserta_id')->references('id')->on('peserta')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peserta_orang_tua');
    }
}
