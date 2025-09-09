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
            $table->foreignId('hotel_id')->constrained()->onDelete('cascade');
            $table->string('room_type');
            $table->string('room_name');
            $table->string('short_description')->nullable();
            $table->text('full_description')->nullable();
            $table->string('room_size')->nullable();
            $table->integer('capacity_adults');
            $table->integer('capacity_children')->default(0);
            $table->integer('max_occupancy');
            $table->string('bed_configuration')->nullable();
            $table->string('bed_type')->nullable();
            $table->integer('bed_count')->default(1);
            $table->string('bed_details')->nullable();
            $table->string('tv_type')->nullable();
            $table->string('tv_size')->nullable();
            $table->boolean('has_wifi')->default(true);
            $table->string('wifi_details')->nullable();
            $table->boolean('has_safe')->default(false);
            $table->string('safe_type')->nullable();
            $table->boolean('has_coffeemaker')->default(false);
            $table->string('coffeemaker_type')->nullable();
            $table->boolean('has_minibar')->default(false);
            $table->boolean('has_balcony')->default(false);
            $table->string('balcony_details')->nullable();
            $table->string('bathroom_type')->nullable();
            $table->string('shower_type')->nullable();
            $table->text('bathroom_amenities')->nullable();
            $table->string('view_type')->nullable();
            $table->string('view_description')->nullable();
            $table->string('proximity_to_beach')->nullable();
            $table->string('floor_range')->nullable();
            $table->text('special_features')->nullable();
            $table->text('accessibility_features')->nullable();
            $table->decimal('base_price', 10, 2);
            $table->string('currency', 3)->default('USD');
            $table->boolean('tax_inclusive')->default(false);
            $table->string('status')->default('active');
            $table->integer('sort_order')->default(0);
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
