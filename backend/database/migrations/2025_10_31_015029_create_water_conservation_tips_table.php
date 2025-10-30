<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('water_conservation_tips', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('title');
            $table->text('description');
            $table->enum('category', ['saving_water', 'leak_prevention', 'conservation', 'maintenance', 'efficiency', 'best_practices']);
            $table->enum('difficulty', ['easy', 'medium', 'hard']);
            $table->integer('potential_savings_percentage')->nullable()->comment('Estimated savings %');
            $table->string('implementation_time')->nullable()->comment('e.g., 5 minutes, 1 hour');
            $table->json('implementation_steps')->nullable();
            $table->json('benefits')->nullable();
            $table->json('required_tools')->nullable();
            $table->json('tags')->nullable();
            $table->enum('status', ['published', 'draft'])->default('published');
            $table->integer('view_count')->default(0);
            $table->integer('like_count')->default(0);
            $table->integer('implementation_count')->default(0);
            $table->json('metadata')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['category', 'status']);
            $table->index('difficulty');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('water_conservation_tips');
    }
};
