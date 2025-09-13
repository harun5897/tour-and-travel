<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('sub_criterias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_criteria');
            $table->string('sub_criteria', 255);
            $table->float('value');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->foreign('id_criteria')->references('id')->on('criterias')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sub_criterias');
    }
};
