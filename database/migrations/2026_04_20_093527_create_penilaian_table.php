<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penilaian', function (Blueprint $table) {

            $table->id();

            $table->foreignId('assessment_id')
                ->constrained('assessments')
                ->cascadeOnDelete();

            $table->integer('nilai_flow')->default(0);
            $table->integer('nilai_subpart')->default(0);
            $table->integer('nilai_qpoint')->default(0);
            $table->integer('nilai_packing')->default(0);

            $table->integer('total_nilai')->default(0);

            $table->boolean('status_lulus')->default(false);

            $table->text('catatan_penilai')->nullable();

            $table->foreignId('dinilai_oleh')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penilaian');
    }
};