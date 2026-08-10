<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Operator extends Model
{
	protected $table='operators';
	protected $fillable=['nama_lengkap','nik','email','jabatan','divisi_id','leader_id','shift_id','is_active'];
	protected $casts=['is_active'=>'boolean'];
	public function divisi()
	{
		return $this->belongsTo(Divisi::class,'divisi_id');
	}
	public function shift()
	{
		return $this->belongsTo(Shift::class,'shift_id');
	}
	public function leader()
	{
		return $this->belongsTo(User::class,'leader_id');
	}
	public function assessments()
	{
		return $this->hasMany(Assessment::class,'operator_id');
	}
	public function notifications()
	{
		return $this->hasMany(Notification::class,'operator_id');
	}
	public function qrTokens()
	{
		return $this->hasMany(QrToken::class,'operator_id');
	}
}