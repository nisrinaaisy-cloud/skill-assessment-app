<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assessment_rules', function (Blueprint $table) {
            $table->id();
            $table->string('kategori'); // stamping, machining, welding, packing

            $table->integer('bobot_flow')->default(0);
            $table->integer('bobot_subpart')->default(0);
            $table->integer('bobot_qpoint')->default(0);
            $table->integer('bobot_packing')->default(0);

            $table->integer('nilai_min_lulus');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assessment_rules');
    }
};