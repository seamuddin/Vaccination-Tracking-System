<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('vaccination_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_id')->constrained('children')->onDelete('cascade');
            $table->foreignId('vaccine_id')->constrained('vaccines')->onDelete('cascade');
            $table->integer('dose_number');
            $table->date('date_given')->nullable();
            $table->date('next_due_date')->nullable();
            $table->enum('status', ['scheduled', 'given', 'missed'])->default('scheduled');
            $table->foreignId('vaccination_center_id')->constrained('vaccination_centers')->onDelete('cascade');
            $table->foreignId('health_worker_id')->nullable()->constrained('users')->onDelete('set null'); // if you have user accounts

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vaccination_records');
    }
};
