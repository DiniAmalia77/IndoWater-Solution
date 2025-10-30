<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alerts', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('customer_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('device_id')->nullable()->constrained()->onDelete('cascade');
            $table->enum('alert_type', ['low_balance', 'leak_detected', 'high_usage', 'device_offline', 'device_tampering', 'maintenance_due', 'payment_due', 'system']);
            $table->enum('severity', ['info', 'warning', 'critical'])->default('info');
            $table->string('title');
            $table->text('message');
            $table->boolean('is_read')->default(false);
            $table->timestamp('read_at')->nullable();
            $table->boolean('is_dismissed')->default(false);
            $table->enum('status', ['active', 'resolved', 'dismissed'])->default('active');
            $table->json('action_data')->nullable()->comment('Data for action buttons');
            $table->json('metadata')->nullable();
            $table->timestamps();
            
            $table->index(['customer_id', 'is_read']);
            $table->index(['device_id', 'alert_type']);
            $table->index(['status', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alerts');
    }
};
