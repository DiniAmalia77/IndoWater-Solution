<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->string('property_name');
            $table->string('property_number')->unique();
            $table->enum('property_type', ['residential', 'commercial', 'industrial', 'government']);
            $table->text('address');
            $table->string('city');
            $table->string('province');
            $table->string('postal_code')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->decimal('area_size', 10, 2)->nullable()->comment('in square meters');
            $table->integer('occupants')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->json('metadata')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['customer_id', 'status']);
            $table->index('property_number');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
