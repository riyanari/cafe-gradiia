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
        Schema::create('menu_cafes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cafe_id')->constrained('cafes')->onDelete('cascade');
            $table->string('name', 50);
            $table->string('category', 50);
            $table->decimal('price', 10, 2)->default(0.00);
            $table->string('img_menu', 255);
            $table->boolean('isAvailable')->default(true);
            $table->boolean('isCustomizable')->default(false);
            $table->boolean('isRecommended')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_cafes');
    }
};
