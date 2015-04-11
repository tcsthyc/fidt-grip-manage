<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class MeasureRecord extends Model {

	//table
	protected $table='measure_records';

	//cols
	//record_local_time: time recorded from mobile device when testing
	protected $fillable = ['record_local_time','total_mvc', 'total_endurance','total_explosive',
							'index_mvc','index_endurance','index_explosive',
							'middle_mvc','middle_endurance','middle_explosive',
							'ring_mvc','ring_endurance','ring_explosive',
							'little_mvc','little_endurance','little_explosive'];

	//user relation
	public function customer(){
		return $this->belongsTo('App\Customer','customer_id');
	}

	//这里暂时以外键的形式关联。按理说如果是按照现有daily形式的记录，则是多对一的形式，但事实上每日的记录和一天之内多次的测试结果显然不能一概而论地寻求关联，这里显然设计的逻辑是有问题的
	public function dailyStatus(){
		return $this->belongsTo('App\DailyStatus',"daily_status_id");
	}

}
