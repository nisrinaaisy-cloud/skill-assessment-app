<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    protected $table = 'parts';

    protected $fillable = [
        'no_part',
        'nama_part',
        'kategori',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function subparts()
    {
        return $this->hasMany(Subpart::class);
    }

   public function assessments()
    {
        return $this->hasMany(Assessment::class);
    }

    public function partProcesses()
    {
        return $this->hasMany(PartProcess::class);
    }

    public function subProcesses()
    {
        return $this->belongsToMany(
            SubProcess::class,
            'part_processes',
            'part_id',
            'sub_process_id'
        )->withPivot('urutan')
        ->orderByPivot('urutan');
    }
        public function partDivisions()
    {
        return $this->hasMany(PartDivision::class);
    }
}