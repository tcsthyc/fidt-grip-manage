<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class HealthTip extends Model {

	//table
	protected $table='health_tips';

	//cols
	protected $fillable = ['title', 'content'];

	//user relation
	public function user(){
		return $this->belongsTo('App\User');
	}


}
