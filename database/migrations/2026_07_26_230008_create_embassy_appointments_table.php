<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('embassy_appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('citizen_id')->constrained('embassy_citizens')->cascadeOnDelete();
            $table->foreignId('slot_id')->constrained('embassy_appointment_slots')->cascadeOnDelete();
            $table->foreignId('service_id')->constrained('embassy_services')->cascadeOnDelete();
            $table->string('reference_number')->unique();
            $table->enum('status', ['pending', 'confirmed', 'completed', 'cancelled', 'no_show'])->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('embassy_appointments');
    }
};
