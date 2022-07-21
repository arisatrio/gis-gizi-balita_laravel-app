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
        Schema::create('tb_data_normalisasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tb_data_training_id')->constrained()->onDelete('cascade');
            $table->float('umur_norm');
            $table->integer('jk_norm');
            $table->float('bb_norm');
            $table->float('tb_norm');
            $table->float('lk_norm');
            $table->float('ld_norm');
            $table->integer('status_norm');
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
        Schema::dropIfExists('tb_normalisasi');
    }
};
