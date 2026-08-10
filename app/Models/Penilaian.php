<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    protected $table = 'penilaian';
    public $timestamps = false;

    protected $fillable = [
        'assessment_id',
        'nilai_flow',
        'nilai_subpart',
        'nilai_qpoint',
        'nilai_packing',
        'total_nilai',
        'status_lulus',
        'catatan_penilai',
        'dinilai_oleh',
    ];

    public function assessment()
    {
        return $this->belongsTo(Assessment::class, 'assessment_id');
    }

    public function leader()
    {
        return $this->belongsTo(User::class, 'dinilai_oleh');
    }
}