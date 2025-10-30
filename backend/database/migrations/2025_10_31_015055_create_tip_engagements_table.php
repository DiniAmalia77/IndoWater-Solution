<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tip_engagements', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('tip_id')->constrained('water_conservation_tips')->onDelete('cascade');
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->boolean('viewed')->default(false);
            $table->boolean('liked')->default(false);
            $table->boolean('bookmarked')->default(false);
            $table->boolean('implemented')->default(false);
            $table->timestamp('viewed_at')->nullable();
            $table->timestamp('liked_at')->nullable();
            $table->timestamp('bookmarked_at')->nullable();
            $table->timestamp('implemented_at')->nullable();
            $table->text('implementation_notes')->nullable();
            $table->integer('implementation_rating')->nullable()->comment('1-5 stars');
            $table->json('metadata')->nullable();
            $table->timestamps();
            
            $table->unique(['tip_id', 'customer_id']);
            $table->index(['customer_id', 'implemented']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tip_engagements');
    }
};
