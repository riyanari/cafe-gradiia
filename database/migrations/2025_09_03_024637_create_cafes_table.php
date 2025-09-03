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
        Schema::create('cafes', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('slug', 100);
            $table->string('place_type', 20);
            $table->time('open');
            $table->time('close');
            $table->float('rating')->default(0);
            $table->integer('tables_num')->default(0);
            $table->boolean('is_takeaway')->default(false);
            $table->string('logo_cafe', 255);
            $table->timestamps();        // created_at, updated_at
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cafes');
    }
};
