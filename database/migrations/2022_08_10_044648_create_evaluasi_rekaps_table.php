<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluasiRekapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluasi_rekaps', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('usia')->nullable();
            $table->string('pendidikan')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('instansi')->nullable();
            $table->integer('category');


            $table->integer('total_skor')->nullable();
            $table->double('rata_rata')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evaluasi_rekaps');
    }
}
