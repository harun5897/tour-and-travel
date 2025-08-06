<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('name', 255);
            $table->string('phone_number', 255);
            $table->string('email', 255)->unique();
            $table->string('address', 255);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
