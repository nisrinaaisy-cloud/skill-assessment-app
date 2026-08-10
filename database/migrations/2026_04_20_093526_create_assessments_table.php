<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assessments', function (Blueprint $table) {

            $table->id();

            $table->foreignId('operator_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('part_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

           $table->foreignId('periode_id')
                ->references('id')
                ->on('periode')
                ->cascadeOnDelete();

            $table->integer('attempt_no')->default(1);

            $table->enum('status', [
                'draft',
                'submitted',
                'dinilai',
                'lulus',
                'tidak_lulus'
            ])->default('draft');

            $table->string('input_nama_part')->nullable();
            $table->string('input_no_part')->nullable();
            $table->string('input_proses')->nullable();

            $table->boolean('is_master_valid')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assessments');
    }
};