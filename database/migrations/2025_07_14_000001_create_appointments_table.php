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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();

            // The child receiving the appointment
            $table->unsignedBigInteger('child_id');
            $table->foreign('child_id')->references('id')->on('children')->onDelete('cascade');

            // Vaccine and dose
            $table->unsignedBigInteger('vaccine_id');
            $table->foreign('vaccine_id')->references('id')->on('vaccines')->onDelete('cascade');

            $table->integer('dose');

            // Vaccine center
            $table->unsignedBigInteger('vaccine_center_id');
            $table->foreign('vaccine_center_id')->references('id')->on('vaccine_centers')->onDelete('cascade');

            // Appointment date
            $table->date('appointment_date');

            // Creator of the appointment (e.g., admin or health worker)
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');

            // Status
            $table->enum('status', ['scheduled', 'completed', 'missed', 'cancelled'])->default('scheduled');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
