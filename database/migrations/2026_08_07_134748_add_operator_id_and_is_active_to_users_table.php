<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up(): void
	{
		Schema::table('users', function (Blueprint $table) {
			$table->foreignId('operator_id')->nullable()->after('id')->constrained('operators')->nullOnDelete();
			$table->boolean('is_active')->default(true)->after('signature');
		});
	}

	public function down(): void
	{
		Schema::table('users', function (Blueprint $table) {
			$table->dropForeign(['operator_id']);
			$table->dropColumn(['operator_id','is_active']);
		});
	}
};