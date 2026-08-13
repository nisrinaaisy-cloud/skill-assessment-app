<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up(): void
	{
		if(!Schema::hasColumn('users','employee_nik')){
			Schema::table('users',function(Blueprint $table){
				$table->string('employee_nik',50)->nullable()->unique()->after('name');
			});
		}

		if(!Schema::hasColumn('users','username')){
			Schema::table('users',function(Blueprint $table){
				$table->string('username',100)->nullable()->unique()->after('employee_nik');
			});
		}

		if(!Schema::hasColumn('users','divisi_id')){
			Schema::table('users',function(Blueprint $table){
				$table->foreignId('divisi_id')->nullable()->after('role')->constrained('divisi')->nullOnDelete();
			});
		}

		if(!Schema::hasColumn('users','is_active')){
			Schema::table('users',function(Blueprint $table){
				$table->boolean('is_active')->default(true)->after('divisi_id');
			});
		}
	}

	public function down(): void
	{
		Schema::table('users',function(Blueprint $table){
			if(Schema::hasColumn('users','employee_nik')){
				$table->dropUnique(['employee_nik']);
				$table->dropColumn('employee_nik');
			}

			if(Schema::hasColumn('users','username')){
				$table->dropUnique(['username']);
				$table->dropColumn('username');
			}

			if(Schema::hasColumn('users','divisi_id')){
				$foreignKeyExists = DB::select("
					SELECT CONSTRAINT_NAME FROM information_schema.TABLE_CONSTRAINTS
					WHERE TABLE_SCHEMA = DATABASE()
					AND TABLE_NAME = 'users'
					AND CONSTRAINT_NAME = 'users_divisi_id_foreign'
				");

				if(!empty($foreignKeyExists)){
					$table->dropForeign(['divisi_id']);
				}

				$table->dropColumn('divisi_id');
			}

			if(Schema::hasColumn('users','is_active')){
				$table->dropColumn('is_active');
			}
		});
	}
};