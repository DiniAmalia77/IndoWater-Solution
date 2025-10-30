<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('water_usage', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('device_id')->constrained()->onDelete('cascade');
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->foreignId('property_id')->constrained()->onDelete('cascade');
            $table->decimal('consumption', 10, 3)->comment('in cubic meters');
            $table->decimal('cost', 15, 2)->comment('in rupiah');
            $table->decimal('rate_per_unit', 10, 2)->comment('price per m3');
            $table->timestamp('reading_date');
            $table->timestamp('previous_reading_date')->nullable();
            $table->decimal('previous_reading', 10, 3)->nullable();
            $table->decimal('current_reading', 10, 3);
            $table->boolean('is_anomaly')->default(false);
            $table->string('anomaly_type')->nullable()->comment('spike, leak, zero_usage, etc');
            $table->text('notes')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();
            
            $table->index(['device_id', 'reading_date']);
            $table->index(['customer_id', 'reading_date']);
            $table->index(['property_id', 'reading_date']);
            $table->index('is_anomaly');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('water_usage');
    }
};
