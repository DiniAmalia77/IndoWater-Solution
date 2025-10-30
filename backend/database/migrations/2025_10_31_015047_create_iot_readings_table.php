<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('iot_readings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('iot_device_id')->constrained()->onDelete('cascade');
            $table->foreignId('device_id')->constrained()->onDelete('cascade');
            $table->decimal('flow_rate', 10, 3)->nullable()->comment('liters per minute');
            $table->decimal('total_volume', 10, 3)->nullable()->comment('cubic meters');
            $table->decimal('pressure', 10, 2)->nullable()->comment('bar or psi');
            $table->decimal('temperature', 5, 2)->nullable()->comment('celsius');
            $table->decimal('water_quality', 5, 2)->nullable()->comment('pH or TDS');
            $table->integer('valve_status')->nullable()->comment('0=closed, 1=open, 2=partial');
            $table->json('raw_data')->nullable();
            $table->timestamp('reading_timestamp');
            $table->timestamps();
            
            $table->index(['iot_device_id', 'reading_timestamp']);
            $table->index(['device_id', 'reading_timestamp']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('iot_readings');
    }
};
