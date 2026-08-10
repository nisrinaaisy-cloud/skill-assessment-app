<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subpart extends Model
{
    protected $table = 'subparts';
    public $timestamps = false;

    protected $fillable = [
        'part_id',
        'nama_subpart',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function part()
    {
        return $this->belongsTo(Part::class, 'part_id');
    }
}