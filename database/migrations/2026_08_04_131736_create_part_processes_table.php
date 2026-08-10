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
    Schema::create('part_processes', function (Blueprint $table) {
        $table->id();
        $table->foreignId('part_id')->constrained('parts')->cascadeOnDelete();
        $table->foreignId('sub_process_id')->constrained('sub_processes')->cascadeOnDelete();
        $table->integer('urutan')->default(1);
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('part_processes');
    }
};
