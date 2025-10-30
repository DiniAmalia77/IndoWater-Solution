<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alert_preferences', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('customer_id')->unique()->constrained()->onDelete('cascade');
            $table->decimal('low_balance_threshold', 15, 2)->default(50000);
            $table->boolean('email_notifications')->default(true);
            $table->boolean('sms_notifications')->default(false);
            $table->boolean('push_notifications')->default(true);
            $table->boolean('leak_alerts')->default(true);
            $table->boolean('high_usage_alerts')->default(true);
            $table->boolean('device_offline_alerts')->default(true);
            $table->boolean('maintenance_alerts')->default(true);
            $table->boolean('payment_alerts')->default(true);
            $table->json('notification_schedule')->nullable()->comment('Time preferences for notifications');
            $table->json('metadata')->nullable();
            $table->timestamps();
            
            $table->index('customer_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alert_preferences');
    }
};
