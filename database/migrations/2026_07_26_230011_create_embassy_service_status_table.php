<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('embassy_service_status', function (Blueprint $table) {
            $table->id();
            $table->string('serviceable_type');
            $table->unsignedBigInteger('serviceable_id');
            $table->string('status');
            $table->text('notes')->nullable();
            $table->foreignId('processed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index(['serviceable_type', 'serviceable_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('embassy_service_status');
    }
};
