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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('order_id', 100)->unique();
            $table->string('transaction_id', 100)->nullable();
            $table->decimal('amount', 12, 2);
            $table->string('payment_type', 50)->nullable();
            $table->string('status', 50)->default('pending');
            $table->text('snap_token')->nullable();
            $table->text('redirect_url')->nullable();
            $table->json('payload')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
