<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    protected $table = 'periode';

    public $timestamps = false;

    protected $fillable = [
        'bulan',
        'tahun'
    ];

    public function assessments()
    {
        return $this->hasMany(Assessment::class, 'periode_id');
    }

    public function getLabelAttribute()
    {
        return str_pad($this->bulan, 2, '0', STR_PAD_LEFT)
            . '/'
            . $this->tahun;
    }
}