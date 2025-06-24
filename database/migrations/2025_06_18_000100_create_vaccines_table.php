<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('vaccines', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('manufacturer')->nullable();
            $table->text('description')->nullable();
            $table->integer('doses_required');   
            $table->integer('age_due_days');         // Age at which the first dose is due
            $table->integer('number_of_doses');      // Total number of doses
            $table->integer('dose_interval_days');   // Interval between doses
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vaccines');
    }
};
