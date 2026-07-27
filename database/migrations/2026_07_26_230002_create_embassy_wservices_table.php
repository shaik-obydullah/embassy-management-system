<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('embassy_wservices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained('embassy_services')->cascadeOnDelete();
            $table->string('name');
            $table->string('description');
            $table->decimal('fee', 10, 2);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('embassy_wservices');
    }
};
