<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('embassy_passports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('citizen_id')->constrained('embassy_citizens')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->enum('application_type', ['new', 'renewal', 'replacement']);
            $table->string('reference_number')->unique();
            $table->string('old_passport_number')->nullable();
            $table->enum('status', ['pending', 'processing', 'ready', 'delivered', 'rejected'])->default('pending');
            $table->date('delivery_date')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('embassy_passports');
    }
};
