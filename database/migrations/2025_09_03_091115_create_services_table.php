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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('category');
            $table->string('subcategory')->nullable();
            $table->decimal('price', 10, 2);
            $table->string('price_type')->default('per_person');
            $table->string('currency', 3)->default('USD');
            $table->boolean('is_available')->default(true);
            $table->boolean('can_add_after_booking')->default(true);
            $table->boolean('requires_quote')->default(false);
            $table->boolean('advance_booking_required')->default(false);
            $table->integer('advance_notice_hours')->nullable();
            $table->string('departure_location')->nullable();
            $table->string('duration')->nullable();
            $table->text('includes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
