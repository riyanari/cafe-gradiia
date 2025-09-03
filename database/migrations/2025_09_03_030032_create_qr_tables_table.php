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
        Schema::create('qr_tables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cafe_id')->constrained('cafes')->cascadeOnDelete();
            $table->string('link_url', 200);
            $table->integer('no_table');
            $table->boolean('is_reserved')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->index('cafe_id');
            $table->index('no_table');

            $table->unique(['cafe_id', 'no_table']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('qr_tables');
    }
};
