<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('subject_type')->comment('Model class name');
            $table->unsignedBigInteger('subject_id')->comment('Model ID');
            $table->enum('activity_type', ['created', 'updated', 'deleted', 'login', 'logout', 'viewed', 'downloaded', 'uploaded', 'sent', 'received', 'other']);
            $table->string('action');
            $table->text('description')->nullable();
            $table->json('properties')->nullable()->comment('Changed properties');
            $table->string('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamps();
            
            $table->index(['subject_type', 'subject_id']);
            $table->index(['user_id', 'created_at']);
            $table->index('activity_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
