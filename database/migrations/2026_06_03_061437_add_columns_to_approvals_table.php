<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('approvals', function (Blueprint $table) {
        $table->foreignId('foreman_id')
            ->nullable()
            ->constrained('users')
            ->nullOnDelete();

        $table->enum('status_foreman', ['pending', 'approved', 'rejected'])
            ->default('pending');

        $table->text('foreman_note')->nullable();

        $table->timestamp('foreman_approved_at')->nullable();

        $table->foreignId('kabag_id')
            ->nullable()
            ->constrained('users')
            ->nullOnDelete();

        $table->enum('status_kabag', ['pending', 'approved', 'rejected'])
            ->default('pending');

        $table->text('kabag_note')->nullable();

        $table->timestamp('kabag_approved_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('approvals', function (Blueprint $table) {
            if (Schema::hasColumn('approvals', 'foreman_id')) {
                $table->dropForeign(['foreman_id']);
            }

            if (Schema::hasColumn('approvals', 'kabag_id')) {
                $table->dropForeign(['kabag_id']);
            }

            $columns = array_filter([
                'foreman_id',
                'status_foreman',
                'foreman_note',
                'foreman_approved_at',
                'kabag_id',
                'status_kabag',
                'kabag_note',
                'kabag_approved_at',
            ], fn ($column) => Schema::hasColumn('approvals', $column));

            if (!empty($columns)) {
                $table->dropColumn($columns);
            }
        });
    }
};