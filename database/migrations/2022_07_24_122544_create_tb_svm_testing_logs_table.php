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
        Schema::create('tb_svm_testing_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tb_svm_parameter_id')->constrained()->onDelete('cascade');
            $table->integer('total_data_to_train')->nullable();
            $table->integer('total_data_to_test')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('tb_svm_testing_logs');
    }
};
