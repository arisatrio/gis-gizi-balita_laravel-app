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
        Schema::create('tb_svm_parameters', function (Blueprint $table) {
            $table->id();
            $table->integer('kernel')->nullable();
            $table->float('c_param')->nullable();
            $table->integer('degree')->nullable();
            $table->float('gamma')->nullable();
            $table->float('coef0')->nullable();
            $table->float('tolerance')->nullable();
            $table->integer('cache')->nullable();
            $table->boolean('probability_estimates')->defaul(1);
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
        Schema::dropIfExists('tb_svm_parameters');
    }
};
