<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesertaPendidikan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peserta_pendidikan', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->id();
            $table->unsignedBigInteger('peserta_id')->nullable();
            $table->string('pendidikan_terakhir')->nullable();
            $table->string('sd')->nullable();
            $table->string('sd_masuk')->nullable();
            $table->string('sd_keluar')->nullable();
            $table->string('smp')->nullable();
            $table->string('smp_masuk')->nullable();
            $table->string('smp_keluar')->nullable();
            $table->string('sma')->nullable();
            $table->string('sma_jurusan')->nullable();
            $table->string('sma_masuk')->nullable();
            $table->string('sma_keluar')->nullable();
            $table->string('kuliah')->nullable();
            $table->string('kuliah_jurusan')->nullable();
            $table->string('kuliah_masuk')->nullable();
            $table->string('kuliah_keluar')->nullable();
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
        Schema::dropIfExists('peserta_pendidikan');
    }
}
