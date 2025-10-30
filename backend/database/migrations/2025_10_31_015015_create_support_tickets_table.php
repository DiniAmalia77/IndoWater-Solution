<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('support_tickets', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('ticket_number')->unique();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->foreignId('assigned_to')->nullable()->constrained('users')->onDelete('set null');
            $table->enum('category', ['technical', 'billing', 'maintenance', 'complaint', 'inquiry', 'other']);
            $table->enum('priority', ['low', 'medium', 'high', 'critical'])->default('medium');
            $table->enum('status', ['open', 'in_progress', 'waiting_customer', 'resolved', 'closed', 'cancelled'])->default('open');
            $table->string('subject');
            $table->text('description');
            $table->timestamp('opened_at');
            $table->timestamp('assigned_at')->nullable();
            $table->timestamp('resolved_at')->nullable();
            $table->timestamp('closed_at')->nullable();
            $table->integer('response_time')->nullable()->comment('in minutes');
            $table->integer('resolution_time')->nullable()->comment('in minutes');
            $table->text('resolution_notes')->nullable();
            $table->integer('customer_rating')->nullable()->comment('1-5 stars');
            $table->text('customer_feedback')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('ticket_number');
            $table->index(['customer_id', 'status']);
            $table->index(['assigned_to', 'status']);
            $table->index(['category', 'priority', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('support_tickets');
    }
};
