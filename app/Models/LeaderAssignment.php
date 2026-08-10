<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaderAssignment extends Model
{
	protected $fillable=[
		'leader_id',
		'divisi_id',
		'is_active',
	];

	public function leader()
	{
		return $this->belongsTo(User::class,'leader_id');
	}

	public function divisi()
	{
		return $this->belongsTo(Divisi::class,'divisi_id');
	}

	public function operators()
	{
		return $this->hasMany(Operator::class,'leader_id','leader_id');
	}
}