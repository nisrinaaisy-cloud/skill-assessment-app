<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('approvals', function (Blueprint $table) {
            if (!Schema::hasColumn('approvals', 'assessment_id')) {
                $table->foreignId('assessment_id')->after('id')->constrained('assessments')->cascadeOnDelete();
            }

            if (!Schema::hasColumn('approvals', 'foreman_id')) {
                $table->foreignId('foreman_id')->nullable()->after('assessment_id')->constrained('users')->nullOnDelete();
            }

            if (!Schema::hasColumn('approvals', 'kabag_id')) {
                $table->foreignId('kabag_id')->nullable()->after('foreman_id')->constrained('users')->nullOnDelete();
            }

            if (!Schema::hasColumn('approvals', 'status_foreman')) {
                $table->string('status_foreman')->default('pending')->after('kabag_id');
            }

            if (!Schema::hasColumn('approvals', 'foreman_note')) {
                $table->text('foreman_note')->nullable()->after('status_foreman');
            }

            if (!Schema::hasColumn('approvals', 'foreman_approved_at')) {
                $table->timestamp('foreman_approved_at')->nullable()->after('foreman_note');
            }

            if (!Schema::hasColumn('approvals', 'status_kabag')) {
                $table->string('status_kabag')->default('pending')->after('foreman_approved_at');
            }

            if (!Schema::hasColumn('approvals', 'kabag_note')) {
                $table->text('kabag_note')->nullable()->after('status_kabag');
            }

            if (!Schema::hasColumn('approvals', 'kabag_approved_at')) {
                $table->timestamp('kabag_approved_at')->nullable()->after('kabag_note');
            }

            if (!Schema::hasColumn('approvals', 'status')) {
                $table->string('status')->default('pending')->after('kabag_approved_at');
            }
        });
    }

    public function down(): void
    {
        Schema::table('approvals', function (Blueprint $table) {
            $table->dropColumn([
                'status',
                'kabag_approved_at',
                'kabag_note',
                'status_kabag',
                'foreman_approved_at',
                'foreman_note',
                'status_foreman',
            ]);

            $table->dropConstrainedForeignId('kabag_id');
            $table->dropConstrainedForeignId('foreman_id');
            $table->dropConstrainedForeignId('assessment_id');
        });
    }
};