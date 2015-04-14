<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class HealthTip extends Model {

	//table
	protected $table='health_tips';

	//cols
	protected $fillable = ['title', 'content'];

	protected $hidden = ['user_id','id','updated_at','created_at'];

	//user relation
	public function user(){
		return $this->belongsTo('App\User','user_id');
	}


}
