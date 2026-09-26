<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('embassy_covid19', function (Blueprint $table) {
            $table->id();
            $table->foreignId('citizen_id')->constrained('embassy_citizens')->cascadeOnDelete();
            $table->enum('vaccination_status', ['unvaccinated', 'partially', 'fully', 'boosted'])->default('unvaccinated');
            $table->date('last_test_date')->nullable();
            $table->enum('test_result', ['negative', 'positive', 'pending'])->nullable();
            $table->string('certificate_path')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('embassy_covid19');
    }
};
