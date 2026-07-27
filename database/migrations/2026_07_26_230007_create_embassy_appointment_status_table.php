<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('embassy_appointment_status', function (Blueprint $table) {
            $table->id();
            $table->foreignId('slot_id')->constrained('embassy_appointment_slots')->cascadeOnDelete();
            $table->integer('current_bookings')->default(0);
            $table->boolean('is_full')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('embassy_appointment_status');
    }
};
