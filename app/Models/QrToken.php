<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QrToken extends Model
{
    protected $table = 'qr_tokens';
    public $timestamps = false;

    protected $fillable = [
        'operator_id',
        'token',
        'expired_at',
    ];

    protected $casts = [
        'expired_at' => 'datetime',
    ];

    public function operator()
    {
        return $this->belongsTo(Operator::class, 'operator_id');
    }
}