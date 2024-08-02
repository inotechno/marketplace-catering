<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('merchant_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('order_id');
            $table->decimal('total_amount', 10, 2);
            $table->string('status');
            $table->dateTime('ordered_at');
            $table->foreignId('payment_method_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('proff_file_path')->nullable();
            $table->string('proff_file_url')->nullable();
            $table->dateTime('payment_at')->nullable();
            $table->string('delivery_address')->nullable();
            $table->string('delivery_contact')->nullable();
            $table->string('delivery_at')->nullable();
            $table->boolean('merchant_confirmation')->default(0);

            $table->string('is_active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
