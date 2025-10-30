<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('voucher_usages', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('voucher_id')->constrained()->onDelete('cascade');
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->foreignId('payment_id')->nullable()->constrained()->onDelete('set null');
            $table->decimal('discount_amount', 15, 2);
            $table->timestamp('used_at');
            $table->json('metadata')->nullable();
            $table->timestamps();
            
            $table->index(['voucher_id', 'customer_id']);
            $table->index('payment_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('voucher_usages');
    }
};
