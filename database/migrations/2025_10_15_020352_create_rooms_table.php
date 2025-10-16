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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();

            // Foreign key untuk hotel
            $table->foreignId('hotel_id')
                  ->constrained('hotels')
                  ->onDelete('cascade');

            $table->string('type'); // Contoh: Standard, Deluxe, Suite
            $table->text('description');
            $table->decimal('price_per_night', 10, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};