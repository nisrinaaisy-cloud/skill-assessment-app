<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubProcess extends Model
{
    protected $table = 'sub_processes';

    protected $fillable = [
        'nama_sub_proses',
        'is_active',
    ];

    /**
     * Relasi ke Part (Many to Many)
     */
    public function parts()
    {
        return $this->belongsToMany(
            Part::class,
            'part_processes',
            'sub_process_id',
            'part_id'
        )->withPivot('urutan');
            }
}