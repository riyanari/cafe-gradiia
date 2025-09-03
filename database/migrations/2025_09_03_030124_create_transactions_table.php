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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('qr_table_id')->constrained('qr_tables')->cascadeOnDelete();
            $table->string('invoice', 255)->unique();
            $table->date('date');
            $table->string('name', 50);
            $table->string('phone_customer', 15);
            $table->decimal('price_amount', 10, 2)->default(0.00);
            $table->boolean('is_takeaway')->default(false);
            $table->boolean('status')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->index('qr_table_id');
            $table->index('invoice');
            $table->index('date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
