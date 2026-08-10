<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('assessments', function (Blueprint $table) {

            $table->foreignId('sub_process_id')
                ->nullable()
                ->after('part_id')
                ->constrained('sub_processes')
                ->nullOnDelete();

        });
    }

    public function down(): void
    {
        Schema::table('assessments', function (Blueprint $table) {

            $table->dropForeign(['sub_process_id']);
            $table->dropColumn('sub_process_id');

        });
    }
};