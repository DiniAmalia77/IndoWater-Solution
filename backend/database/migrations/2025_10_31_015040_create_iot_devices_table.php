<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('iot_devices', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('device_id')->constrained()->onDelete('cascade');
            $table->string('device_secret')->unique()->comment('Authentication key for IoT device');
            $table->string('mac_address')->unique()->nullable();
            $table->string('ip_address')->nullable();
            $table->string('firmware_version')->default('1.0.0');
            $table->string('hardware_version')->default('1.0.0');
            $table->enum('connection_type', ['wifi', 'ethernet', 'cellular', 'lora'])->default('wifi');
            $table->integer('signal_strength')->nullable()->comment('Signal strength in dBm');
            $table->integer('battery_level')->nullable()->comment('Battery percentage 0-100');
            $table->timestamp('last_heartbeat_at')->nullable();
            $table->timestamp('last_data_at')->nullable();
            $table->integer('uptime')->default(0)->comment('Uptime in seconds');
            $table->integer('reboot_count')->default(0);
            $table->json('configuration')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();
            
            $table->index('device_id');
            $table->index('device_secret');
            $table->index('last_heartbeat_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('iot_devices');
    }
};
