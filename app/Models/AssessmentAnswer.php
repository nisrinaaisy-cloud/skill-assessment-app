<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssessmentAnswer extends Model
{
    protected $fillable = [
        'assessment_id',
        'flow_process',
        'nama_subpart',
        'q_point',
        'standard_packing',
    ];

    public function assessment()
    {
        return $this->belongsTo(Assessment::class);
    }
}