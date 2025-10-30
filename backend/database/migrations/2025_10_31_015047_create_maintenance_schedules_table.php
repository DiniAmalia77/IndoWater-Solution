<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('maintenance_schedules', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('device_id')->constrained()->onDelete('cascade');
            $table->foreignId('assigned_to')->nullable()->constrained('users')->onDelete('set null');
            $table->enum('maintenance_type', ['routine', 'preventive', 'corrective', 'emergency']);
            $table->string('title');
            $table->text('description')->nullable();
            $table->timestamp('scheduled_at');
            $table->timestamp('completed_at')->nullable();
            $table->enum('status', ['scheduled', 'in_progress', 'completed', 'cancelled', 'rescheduled'])->default('scheduled');
            $table->enum('priority', ['low', 'medium', 'high', 'critical'])->default('medium');
            $table->integer('estimated_duration')->nullable()->comment('in minutes');
            $table->integer('actual_duration')->nullable()->comment('in minutes');
            $table->text('notes')->nullable();
            $table->json('checklist')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['device_id', 'scheduled_at']);
            $table->index(['assigned_to', 'status']);
            $table->index(['status', 'scheduled_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('maintenance_schedules');
    }
};
