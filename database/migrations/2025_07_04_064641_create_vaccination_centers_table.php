<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVaccinationCentersTable extends Migration
{
    public function up(): void
    {
        Schema::create('vaccination_centers', function (Blueprint $table) {
            $table->id();
            $table->string('name');                            // Center name
            $table->text('address');                           // Full address
            $table->string('phone')->nullable();               // Contact number
            $table->string('email')->nullable();               // Optional email
            $table->string('google_place_id')->nullable();     // Google Place ID if using Maps API
            $table->decimal('latitude', 10, 7)->nullable();    // GPS coordinates
            $table->decimal('longitude', 10, 7)->nullable();   // GPS coordinates
            $table->boolean('is_active')->default(true);       // Active/inactive flag
            $table->timestamps();                              // created_at, updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vaccination_centers');
    }
}

