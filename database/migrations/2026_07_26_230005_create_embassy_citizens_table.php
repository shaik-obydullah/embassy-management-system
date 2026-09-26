<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('embassy_citizens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('first_name');
            $table->string('last_name');
            $table->date('date_of_birth');
            $table->enum('gender', ['male', 'female', 'other']);
            $table->string('nationality')->default('Bangladeshi');
            $table->string('passport_number')->nullable();
            $table->date('passport_expiry')->nullable();
            $table->string('residence_card_number')->nullable();
            $table->date('residence_card_expiry')->nullable();
            $table->string('phone');
            $table->string('email');
            $table->text('address');
            $table->foreignId('area_id')->nullable()->constrained('embassy_areas')->nullOnDelete();
            $table->foreignId('occupation_id')->nullable()->constrained('embassy_occupations')->nullOnDelete();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->enum('marital_status', ['single', 'married', 'divorced', 'widowed'])->default('single');
            $table->string('photo_path')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('embassy_citizens');
    }
};
