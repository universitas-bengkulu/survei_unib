<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sarans', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('usia')->nullable();
            $table->string('pendidikan')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('instansi')->nullable();

            $table->text('saran')->nullable();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');

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
        Schema::dropIfExists('sarans');
    }
}
