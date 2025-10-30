<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->string('reference_id')->unique();
            $table->string('external_id')->nullable()->comment('Payment gateway transaction ID');
            $table->decimal('amount', 15, 2);
            $table->decimal('discount_amount', 15, 2)->default(0);
            $table->decimal('final_amount', 15, 2);
            $table->enum('payment_method', ['virtual_account', 'qris', 'e_wallet', 'credit_card', 'bank_transfer', 'manual']);
            $table->string('payment_provider')->nullable()->comment('midtrans, xendit, etc');
            $table->enum('status', ['pending', 'paid', 'failed', 'expired', 'refunded']);
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->string('payment_url')->nullable();
            $table->string('account_number')->nullable()->comment('VA number or account');
            $table->text('description')->nullable();
            $table->json('metadata')->nullable();
            $table->json('callback_data')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['customer_id', 'status']);
            $table->index('reference_id');
            $table->index('external_id');
            $table->index(['status', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
