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
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->foreignId('destination_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained('hotel_categories')->onDelete('cascade');
            $table->string('setting_type')->nullable();
            $table->string('style')->nullable();
            $table->integer('total_rooms');
            $table->text('description')->nullable();
            $table->string('short_description')->nullable();
            $table->text('highlight_features')->nullable();
            $table->string('address');
            $table->string('city');
            $table->string('state_province')->nullable();
            $table->string('country');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->time('check_in_time')->nullable();
            $table->time('check_out_time')->nullable();
            $table->integer('minimum_check_in_age')->nullable();
            $table->string('pet_policy')->nullable();
            $table->text('cancellation_policy')->nullable();
            $table->text('amenities')->nullable();
            $table->text('awards')->nullable();
            $table->text('sustainability_features')->nullable();
            $table->boolean('parking_available')->default(false);
            $table->string('parking_type')->nullable();
            $table->text('parking_details')->nullable();
            $table->string('distance_to_airport')->nullable();
            $table->text('nearby_attractions')->nullable();
            $table->string('status')->default('active');
            $table->boolean('featured')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};
