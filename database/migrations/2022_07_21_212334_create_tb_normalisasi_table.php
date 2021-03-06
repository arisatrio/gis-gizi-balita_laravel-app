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
        Schema::create('tb_data_normalisasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tb_data_training_id')->constrained()->onDelete('cascade');
            $table->decimal('umur_norm', 8, 5);
            $table->integer('jk_norm');
            $table->decimal('bb_norm', 8, 5);
            $table->boolean('status_norm');
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
