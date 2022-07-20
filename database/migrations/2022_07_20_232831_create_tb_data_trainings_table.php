<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_data_trainings', function (Blueprint $table) {
            $table->id();
            $table->integer('umur');
            $table->enum('jk', ['L', 'P']);
            $table->integer('bb');
            $table->integer('tb');
            $table->integer('lk');
            $table->integer('ld');
            $table->enum('status', ['buruk', 'kurang', 'baik', 'lebih']);
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
        Schema::dropIfExists('tb_data_trainings');
    }
};
