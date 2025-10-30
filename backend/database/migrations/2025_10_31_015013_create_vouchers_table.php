<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('code')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->enum('discount_type', ['percentage', 'fixed']);
            $table->decimal('discount_value', 10, 2);
            $table->decimal('max_discount_amount', 15, 2)->nullable()->comment('Max discount for percentage');
            $table->decimal('min_purchase_amount', 15, 2)->default(0);
            $table->integer('usage_limit')->nullable()->comment('Total usage limit');
            $table->integer('usage_count')->default(0);
            $table->integer('per_customer_limit')->default(1);
            $table->timestamp('valid_from');
            $table->timestamp('valid_until');
            $table->enum('status', ['active', 'inactive', 'expired'])->default('active');
            $table->json('metadata')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('code');
            $table->index(['status', 'valid_from', 'valid_until']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
