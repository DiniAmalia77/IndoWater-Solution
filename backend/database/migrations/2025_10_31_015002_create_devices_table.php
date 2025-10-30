<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('property_id')->constrained()->onDelete('cascade');
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->string('device_number')->unique();
            $table->string('device_name');
            $table->enum('device_type', ['water_meter', 'flow_sensor', 'pressure_sensor', 'quality_sensor', 'smart_valve']);
            $table->string('serial_number')->unique();
            $table->string('firmware_version')->nullable();
            $table->string('hardware_version')->nullable();
            $table->enum('status', ['active', 'inactive', 'maintenance', 'faulty'])->default('active');
            $table->enum('connection_status', ['online', 'offline'])->default('offline');
            $table->timestamp('last_reading_at')->nullable();
            $table->decimal('last_reading_value', 10, 3)->nullable();
            $table->integer('health_score')->default(100)->comment('0-100');
            $table->timestamp('installed_at')->nullable();
            $table->timestamp('last_maintenance_at')->nullable();
            $table->timestamp('next_maintenance_at')->nullable();
            $table->integer('alert_count')->default(0);
            $table->json('metadata')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['property_id', 'status']);
            $table->index(['customer_id', 'status']);
            $table->index('device_number');
            $table->index('serial_number');
            $table->index('connection_status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};
