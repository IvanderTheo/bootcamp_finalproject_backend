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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('invoice_number');
            $table->timestamp('transaction_date');
            $table->decimal('total_amount',12,2);
            $table->decimal('tax',12,2)->nullable();
            $table->decimal('discount',12,2)->nullable();
            $table->decimal('grand_total',12,2);
            $table->enum('status',['pending','paid','cancelled']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
