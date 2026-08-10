<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartProcess extends Model
{
    protected $table = 'part_processes';

    protected $fillable = [
        'part_id',
        'sub_process_id',
        'urutan'
    ];

    public function part()
    {
        return $this->belongsTo(Part::class);
    }

    public function subProcess()
    {
        return $this->belongsTo(SubProcess::class);
    }
}