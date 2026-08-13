<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('leader_assignments', 'divisi_id')) {
            Schema::table('leader_assignments', function (Blueprint $table) {
                $table->foreign('divisi_id')
                      ->references('id')
                      ->on('divisi')
                      ->cascadeOnDelete();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('leader_assignments', 'divisi_id')) {
            Schema::table('leader_assignments', function (Blueprint $table) {
                $table->dropForeign(['divisi_id']);
            });
        }
    }
};