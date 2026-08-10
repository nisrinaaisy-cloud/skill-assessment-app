<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\SubProcess;

class Assessment extends Model
{
    protected $table = 'assessments';

    public $timestamps = true;

    protected $fillable = [
        'operator_id',
        'part_id',
        'sub_process_id',
        'periode_id',
        'attempt_no',
        'status',
        'input_nama_part',
        'input_no_part',
        'input_proses',
        'is_master_valid',
        'approved_foreman_by',
        'approved_foreman_at',
        'approved_kabag_by',
        'approved_kabag_at',
    ];

    protected $casts = [
        'is_master_valid' => 'boolean',
        'approved_foreman_at' => 'datetime',
        'approved_kabag_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relasi Operator
     */
    public function operator()
    {
        return $this->belongsTo(Operator::class, 'operator_id');
    }

    /**
     * Relasi Part
     */
    public function part()
    {
        return $this->belongsTo(Part::class);
    }

    public function subProcess()
    {
        return $this->belongsTo(SubProcess::class);
    }
    /**
     * Relasi Sub Process
     */

    /**
     * Relasi Periode
     */
    public function periode()
    {
        return $this->belongsTo(Periode::class, 'periode_id');
    }

    /**
     * Relasi Jawaban Assessment
     */
    public function answer()
    {
        return $this->hasOne(AssessmentAnswer::class, 'assessment_id');
    }

    /**
     * Relasi Penilaian
     */
    public function penilaian()
    {
        return $this->hasOne(Penilaian::class, 'assessment_id', 'id');
    }

    /**
     * Relasi Approval
     */
    public function approval()
    {
        return $this->hasOne(Approval::class, 'assessment_id');
    }

    /**
     * Relasi Notifikasi
     */
    public function notifications()
    {
        return $this->hasMany(Notification::class, 'assessment_id');
    }
}