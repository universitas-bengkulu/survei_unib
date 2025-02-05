<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluasiDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluasi_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('evaluasi_rekap_id')->constrained('evaluasi_rekaps')->onDelete('cascade');
            $table->string('variable');
            $table->string('isi');

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
        Schema::dropIfExists('evaluasi_data');
    }
}
