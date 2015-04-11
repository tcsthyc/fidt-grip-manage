<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model {

	//table
	protected $table='customers';

	//cols
	//bfp:body fat percentage
	protected $fillable = ['name', 'password','age','height','weight','sex','bfp'];

	//user relation
	public function user(){
		return $this->belongsTo('App\Customer','user_id');
	}

}
