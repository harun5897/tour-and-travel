<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('booking_code', 255)->unique()->comment('Unique booking code');
            $table->string('guest_name', 255);
            $table->integer('total_adult');
            $table->integer('total_child')->nullable();
            $table->unsignedBigInteger('package_id');
            $table->foreign('package_id')->references('id')->on('packages')->onDelete('cascade');
            $table->date('booking_date');
            $table->date('arrival_date');
            $table->date('departure_date');
            $table->decimal('price', 15, 2);
            $table->enum('platform', ['whatsapp', 'email', 'facebook', 'instagram'])->nullable();
            $table->unsignedBigInteger('sales_id');
            $table->foreign('sales_id')->references('id')->on('sales')->onDelete('cascade');
            $table->enum('status', ['not_paid', 'completed', 'cancel', 'refund'])->default('not_paid');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
