<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartSubProcess extends Model
{
    protected $fillable = [
        'part_id',
        'nama_sub_proses',
    ];

    public function part()
    {
        return $this->belongsTo(Part::class);
    }
}