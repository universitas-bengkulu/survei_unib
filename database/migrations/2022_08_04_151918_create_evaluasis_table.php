<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('evaluasi_rekap_id')->constrained('evaluasi_rekaps')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->foreignId('indikator_id')->nullable()->constrained('indikators')->onDelete('set null');
            $table->string('nama_indikator')->nullable();
            $table->integer('skor')->nullable();
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
        Schema::dropIfExists('evaluasis');
    }
}
