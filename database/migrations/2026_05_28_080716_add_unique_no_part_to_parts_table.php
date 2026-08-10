<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $indexExists = DB::select("
            SHOW INDEX FROM parts 
            WHERE Key_name = 'parts_no_part_unique'
        ");

        if (empty($indexExists)) {
            Schema::table('parts', function (Blueprint $table) {
                $table->unique('no_part');
            });
        }
    }

    public function down(): void
    {
        $indexExists = DB::select("
            SHOW INDEX FROM parts 
            WHERE Key_name = 'parts_no_part_unique'
        ");

        if (!empty($indexExists)) {
            Schema::table('parts', function (Blueprint $table) {
                $table->dropUnique('parts_no_part_unique');
            });
        }
    }
};