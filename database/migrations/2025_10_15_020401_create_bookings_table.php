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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            
            // Foreign key untuk user
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            // Foreign key untuk kamar
            $table->foreignId('room_id')
                  ->constrained('rooms')
                  ->onDelete('cascade');
                  
            $table->date('check_in_date');
            $table->date('check_out_date');
            $table->decimal('total_price', 10, 2);
            $table->string('status')->default('confirmed'); // Contoh: confirmed, cancelled
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};