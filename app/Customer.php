<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model {

	//table
	protected $table='customers';

	//cols
	//bfp:body fat percentage
	protected $fillable = ['name','age','height','weight','sex','bfp','telephone','avatar'];

	//user relation
	public function user(){
		return $this->belongsTo('App\Customer','user_id');
	}

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password'];


}
