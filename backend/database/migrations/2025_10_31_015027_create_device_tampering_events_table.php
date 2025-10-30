<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('device_tampering_events', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('device_id')->constrained()->onDelete('cascade');
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->foreignId('alert_id')->nullable()->constrained()->onDelete('set null');
            $table->enum('tampering_type', ['physical_damage', 'unauthorized_access', 'sensor_manipulation', 'connection_tampering', 'reading_manipulation']);
            $table->enum('severity', ['minor', 'moderate', 'major', 'critical']);
            $table->text('description');
            $table->timestamp('detected_at');
            $table->timestamp('verified_at')->nullable();
            $table->timestamp('resolved_at')->nullable();
            $table->enum('status', ['detected', 'investigating', 'confirmed', 'false_positive', 'resolved'])->default('detected');
            $table->text('action_taken')->nullable();
            $table->json('detection_data')->nullable();
            $table->timestamps();
            
            $table->index(['device_id', 'status']);
            $table->index(['customer_id', 'detected_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('device_tampering_events');
    }
};
