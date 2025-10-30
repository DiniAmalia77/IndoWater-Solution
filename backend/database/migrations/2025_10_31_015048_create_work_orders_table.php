<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('work_orders', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('work_order_number')->unique();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->foreignId('property_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('device_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('assigned_to')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('support_ticket_id')->nullable()->constrained('support_tickets')->onDelete('set null');
            $table->enum('work_type', ['installation', 'repair', 'maintenance', 'inspection', 'removal', 'upgrade']);
            $table->string('title');
            $table->text('description');
            $table->enum('priority', ['low', 'medium', 'high', 'critical'])->default('medium');
            $table->enum('status', ['pending', 'assigned', 'in_progress', 'on_hold', 'completed', 'cancelled'])->default('pending');
            $table->timestamp('scheduled_at')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->integer('estimated_duration')->nullable()->comment('in minutes');
            $table->integer('actual_duration')->nullable()->comment('in minutes');
            $table->text('work_summary')->nullable();
            $table->text('parts_used')->nullable();
            $table->decimal('labor_cost', 15, 2)->nullable();
            $table->decimal('parts_cost', 15, 2)->nullable();
            $table->decimal('total_cost', 15, 2)->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->json('checklist')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('work_order_number');
            $table->index(['customer_id', 'status']);
            $table->index(['assigned_to', 'status']);
            $table->index(['device_id', 'work_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('work_orders');
    }
};
