<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
	use HasFactory,Notifiable;

	protected $table='users';

	protected $fillable=[
		'name',
		'employee_nik',
		'username',
		'email',
		'password',
		'role',
		'divisi_id',
		'is_active',
		'signature',
	];

	protected $hidden=[
		'password',
		'remember_token',
	];

	protected function casts(): array
	{
		return [
			'is_active'=>'boolean',
		];
	}

	public function divisi()
	{
		return $this->belongsTo(Divisi::class,'divisi_id');
	}

	public function operatorBawahan()
	{
		return $this->hasMany(Operator::class,'leader_id');
	}

	public function leaderAssignments()
	{
		return $this->hasMany(LeaderAssignment::class,'leader_id');
	}

	public function notifications()
	{
		return $this->hasMany(Notification::class,'user_id');
	}

	public function divisis()
	{
		return $this->belongsToMany(
			Divisi::class,
			'user_divisi',
			'user_id',
			'divisi_id'
		);
	}
}