<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up(): void
	{
		if(!Schema::hasColumn('leader_assignments','leader_id')){
			Schema::table('leader_assignments',function(Blueprint $table){
				$table->foreignId('leader_id')
					->nullable()
					->after('id')
					->constrained('users')
					->nullOnDelete();
			});
		}

		if(!Schema::hasColumn('leader_assignments','divisi_id')){
			Schema::table('leader_assignments',function(Blueprint $table){
				$table->foreignId('divisi_id')
					->nullable()
					->after('leader_id')
					->constrained('divisi')
					->nullOnDelete();
			});
		}

		if(!Schema::hasColumn('leader_assignments','is_active')){
			Schema::table('leader_assignments',function(Blueprint $table){
				$table->boolean('is_active')->default(true)->after('divisi_id');
			});
		}
	}

	public function down(): void
	{
		Schema::table('leader_assignments',function(Blueprint $table){
			if(Schema::hasColumn('leader_assignments','leader_id')){
				$table->dropForeign(['leader_id']);
				$table->dropColumn('leader_id');
			}

			if(Schema::hasColumn('leader_assignments','divisi_id')){
				$table->dropForeign(['divisi_id']);
				$table->dropColumn('divisi_id');
			}

			if(Schema::hasColumn('leader_assignments','is_active')){
				$table->dropColumn('is_active');
			}
		});
	}
};