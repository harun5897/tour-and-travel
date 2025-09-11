<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('criterias', function (Blueprint $table) {
            $table->id();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('criteria', 255)->comment('Nama kriteria');
            $table->float('value')->comment('Nilai kriteria (bisa berkoma)');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('criterias');
    }
};
