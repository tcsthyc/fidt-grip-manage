<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class DailyStatus extends Model {

	//table
	protected $table='daily_statuses';

	//cols
	//record_local_time: time recorded from mobile device when testing
	protected $fillable = ['record_local_time','exercise_type', 'exercise_total_time','had_breakfast','had_lunch','had_supper'];

	//user relation
	public function user(){
		return $this->belongsTo('App\Customer','customer_id');
	}

}
