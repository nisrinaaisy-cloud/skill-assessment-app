<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('assessment_answers', function (Blueprint $table) {
            $table->unsignedBigInteger('assessment_id')->after('id');

            $table->text('flow_process')->nullable()->after('assessment_id');
            $table->text('nama_subpart')->nullable()->after('flow_process');
            $table->text('q_point')->nullable()->after('nama_subpart');
            $table->text('standard_packing')->nullable()->after('q_point');

            $table->foreign('assessment_id')
                ->references('id')
                ->on('assessments')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('assessment_answers', function (Blueprint $table) {
            $table->dropForeign(['assessment_id']);

            $table->dropColumn([
                'assessment_id',
                'flow_process',
                'nama_subpart',
                'q_point',
                'standard_packing',
            ]);
        });
    }
};