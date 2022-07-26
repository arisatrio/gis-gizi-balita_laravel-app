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
        Schema::create('tb_balitas', function (Blueprint $table) {
            $table->id();
            $table->string('id_kia');
            $table->foreignId('tb_posyandu_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('parent_id');
            $table->string('name');
            $table->date('birth');
            $table->enum('gender', ['L', 'P']);
            $table->text('address');
            $table->boolean('status')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('parent_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_balitas');
    }
};
