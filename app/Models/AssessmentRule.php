<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssessmentRule extends Model
{
    protected $table = 'assessment_rules';
    public $timestamps = false;

    protected $fillable = [
        'kategori',
        'bobot_flow',
        'bobot_subpart',
        'bobot_qpoint',
        'bobot_packing',
        'nilai_min_lulus',
    ];
}