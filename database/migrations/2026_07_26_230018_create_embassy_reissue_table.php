<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('embassy_reissue', function (Blueprint $table) {
            $table->id();
            $table->foreignId('citizen_id')->constrained('embassy_citizens')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('passport_id')->constrained('embassy_passports')->cascadeOnDelete();
            $table->text('reason');
            $table->string('reference_number')->unique();
            $table->enum('status', ['pending', 'approved', 'rejected', 'completed'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('embassy_reissue');
    }
};
