<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    protected $table = 'divisi';
    public $timestamps = false;

    protected $fillable = ['nama_divisi'];

    public function operators()
    {
        return $this->hasMany(Operator::class, 'divisi_id');
    }
    public function foremans()
    {
        return $this->belongsToMany(
            \App\Models\User::class,
            'user_divisi',
            'divisi_id',
            'user_id'
        );
    }
    public function partDivisions()
    {
        return $this->hasMany(PartDivision::class,'division_id');
    }
}