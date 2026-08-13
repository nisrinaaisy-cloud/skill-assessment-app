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
        Schema::table('parts', function (Blueprint $table) {

            if (Schema::hasColumn('parts', 'divisi_id')) {
                $table->dropForeign(['divisi_id']);
                $table->dropColumn('divisi_id');
            }

            if (Schema::hasColumn('parts', 'proses')) {
                $table->dropColumn('proses');
            }

        });
    }

    public function down(): void
    {
        Schema::table('parts', function (Blueprint $table) {

            if (!Schema::hasColumn('parts', 'proses')) {
                $table->string('proses')->nullable();
            }

            if (!Schema::hasColumn('parts', 'divisi_id')) {
                $table->foreignId('divisi_id')
                    ->nullable()
                    ->constrained('divisi');
            }

        });
    }
};
