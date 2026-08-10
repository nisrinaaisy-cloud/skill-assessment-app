<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('operators', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('nik', 50)->unique();
            $table->string('jabatan', 100)->nullable();
            $table->foreignId('divisi_id')->constrained('divisi')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('shift_id')->constrained('shift')->cascadeOnUpdate()->restrictOnDelete();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('operators');
    }
};