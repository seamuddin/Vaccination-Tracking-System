<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_types', function (Blueprint $table) {
            $table->id();
            $table->char('type_id', 4);
            $table->string('code', 20);
            $table->string('name', 40);
            $table->integer('order');
        });

        DB::table('user_types')->insert([
            ['type_id' => 'A-1001', 'code' => 'admin', 'name' => 'Admin', 'order' => 0],
            ['type_id' => 'G-2002', 'code' => 'general', 'name' => 'General', 'order' => 1],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_types');
    }
};
