<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up(): void
	{
		Schema::table('users', function (Blueprint $table) {
			if (!Schema::hasColumn('users', 'operator_id')) {
				$table->foreignId('operator_id')->nullable()->after('id')->constrained('operators')->nullOnDelete();
			}

			if (!Schema::hasColumn('users', 'is_active')) {
				$table->boolean('is_active')->default(true)->after('signature');
			}
		});
	}

	public function down(): void
	{
		Schema::table('users', function (Blueprint $table) {
			if (Schema::hasColumn('users', 'operator_id')) {
				$foreignKeyExists = DB::select("
					SELECT CONSTRAINT_NAME FROM information_schema.TABLE_CONSTRAINTS
					WHERE TABLE_SCHEMA = DATABASE()
					AND TABLE_NAME = 'users'
					AND CONSTRAINT_NAME = 'users_operator_id_foreign'
					AND CONSTRAINT_TYPE = 'FOREIGN KEY'
				");

				if (!empty($foreignKeyExists)) {
					$table->dropForeign(['operator_id']);
				}

				$table->dropColumn('operator_id');
			}

			if (Schema::hasColumn('users', 'is_active')) {
				$table->dropColumn('is_active');
			}
		});
	}
};