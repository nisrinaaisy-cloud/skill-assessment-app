<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('assessments', function (Blueprint $table) {
            $table->foreignId('approved_foreman_by')->nullable();
            $table->timestamp('approved_foreman_at')->nullable();
            $table->foreignId('approved_kabag_by')->nullable();
            $table->timestamp('approved_kabag_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('assessments', function (Blueprint $table) {
            $table->dropColumn([
                'approved_foreman_by',
                'approved_foreman_at',
                'approved_kabag_by',
                'approved_kabag_at',
            ]);
        });
    }
};