<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    protected $table = 'shift';
    public $timestamps = false;

    protected $fillable = ['nama_shift'];

    public function operators()
    {
        return $this->hasMany(Operator::class, 'shift_id');
    }
}