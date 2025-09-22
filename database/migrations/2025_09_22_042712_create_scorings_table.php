<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('scorings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_package');
            $table->unsignedBigInteger('id_criteria');
            $table->unsignedBigInteger('id_sub_criteria');

            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->foreign('id_package')->references('id')->on('packages')->onDelete('cascade');
            $table->foreign('id_criteria')->references('id')->on('criterias')->onDelete('cascade');
            $table->foreign('id_sub_criteria')->references('id')->on('sub_criterias')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('scorings');
    }
};
