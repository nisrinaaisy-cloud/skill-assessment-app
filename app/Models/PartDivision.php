<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartDivision extends Model
{
    protected $fillable = [
        'part_id',
        'division_id'
    ];

    public function part()
    {
        return $this->belongsTo(Part::class);
    }

    public function division()
    {
        return $this->belongsTo(Divisi::class,'division_id');
    }

    public function processes()
    {
        return $this->hasMany(PartProcess::class);
    }
}