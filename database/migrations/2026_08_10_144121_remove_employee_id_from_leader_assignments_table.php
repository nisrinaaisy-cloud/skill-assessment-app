<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('leader_assignments', function (Blueprint $table) {
            if (Schema::hasColumn('leader_assignments', 'employee_id')) {
                $table->dropColumn('employee_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('leader_assignments', function (Blueprint $table) {
            if (!Schema::hasColumn('leader_assignments', 'employee_id')) {
                $table->unsignedBigInteger('employee_id')->nullable()->after('leader_id');
            }
        });
    }
};