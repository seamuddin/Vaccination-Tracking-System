<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('children', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('date_of_birth');
            $table->enum('gender', ['male', 'female', 'other'])->default('male');
            $table->string('guardian_name');
            $table->string('guardian_contact')->nullable();
            $table->integer('birth_certificate_no');
            $table->text('birth_certificate');
            $table->foreignId('parent_id')->nullable()->constrained('users')->onDelete('cascade'); // optional if you have user accounts
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('children');
    }
};
