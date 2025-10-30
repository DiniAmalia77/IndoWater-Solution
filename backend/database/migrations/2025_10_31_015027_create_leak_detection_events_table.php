<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leak_detection_events', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('device_id')->constrained()->onDelete('cascade');
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->foreignId('alert_id')->nullable()->constrained()->onDelete('set null');
            $table->enum('leak_type', ['continuous_flow', 'night_usage', 'sudden_spike', 'gradual_increase']);
            $table->enum('severity', ['minor', 'moderate', 'major', 'critical']);
            $table->decimal('detected_flow_rate', 10, 3)->comment('liters per minute');
            $table->decimal('normal_flow_rate', 10, 3)->comment('liters per minute');
            $table->decimal('estimated_loss', 10, 3)->nullable()->comment('estimated water loss in m3');
            $table->decimal('estimated_cost', 15, 2)->nullable()->comment('estimated cost in rupiah');
            $table->timestamp('detected_at');
            $table->timestamp('resolved_at')->nullable();
            $table->enum('status', ['detected', 'investigating', 'confirmed', 'false_positive', 'resolved'])->default('detected');
            $table->text('notes')->nullable();
            $table->json('detection_data')->nullable();
            $table->timestamps();
            
            $table->index(['device_id', 'status']);
            $table->index(['customer_id', 'detected_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leak_detection_events');
    }
};
