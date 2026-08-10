<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    protected $table = 'approvals';

    public $timestamps = true;

    protected $fillable = [
        'assessment_id',
        'foreman_id',
        'kabag_id',
        'status_foreman',
        'foreman_note',
        'foreman_approved_at',
        'status_kabag',
        'kabag_note',
        'kabag_approved_at',
        'status',
    ];

    protected $casts = [
        'foreman_approved_at' => 'datetime',
        'kabag_approved_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function assessment()
    {
        return $this->belongsTo(Assessment::class, 'assessment_id');
    }

    public function foreman()
    {
        return $this->belongsTo(User::class, 'foreman_id');
    }

    public function kabag()
    {
        return $this->belongsTo(User::class, 'kabag_id');
    }
}