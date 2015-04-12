<?php namespace App\Http\Controllers;

/*
	timezone: PRC
	


*/

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\HealthTip;
use App\Customer;
use App\DailyStatus;
use App\APIResponseGenerator as APIResponse;

class APIController extends Controller {

	public function __construct(){
		$this->middleware('customerVerify',['only' => ['postDailyRecord','postMeasureRecord']]);
	}

	public function getTips(Request $request){
		$page=1;
		$pageSize=20;
		if($request->page){
			$page=$request->page;
		}

		$tipData=HealthTip::forPage($page,$pageSize)->toJson();
		return APIResponse::successResult($tipData);
	}

	//如果当天有数据则更新，否则新建记录
	/*
		request sample:{
			username: string,
			recordLocalTime: timeMillis,
			exerciseType: string,
			exerciseTotalTime:int,
			hadBreakfast: bool;
			hadLunch: bool;
			hadSupper: bool;
		}
	*/
	public function postDailyStatus(Request $Request){
		$customerName=$request->username;
		$customer=Customer::where('name',$customerName);

		$currTime=time();
		$dailyStatus=DailyStatus::where('customer_id',$customer->id)->whereRaw('DateDiff(dd,updated_at,$currTime)=0');
		if($dailyStatus){
			$dailyStatus-> record_local_time= $request-> recordLocalTime;
			$dailyStatus-> exercise_type= $request-> exerciseType;
			$dailyStatus-> exercise_total_time= $request-> exerciseTotalTime;
			$dailyStatus-> had_breakfast= $request-> hadBreakfast;
			$dailyStatus-> had_lunch= $request-> hadLunch;
			$dailyStatus-> had_supper= $request-> hadSupper;
			$dailyStatus-> save();
		}
		else{
			$dailyStatus= new DailyStatus;
			$dailyStatus-> record_local_time= $request-> recordLocalTime;
			$dailyStatus-> exercise_type= $request-> exerciseType;
			$dailyStatus-> exercise_total_time= $request-> exerciseTotalTime;
			$dailyStatus-> had_breakfast= $request-> hadBreakfast;
			$dailyStatus-> had_lunch= $request-> hadLunch;
			$dailyStatus-> had_supper= $request-> hadSupper;
			$dailyStatus-> customer()-> associate($customer);
			$dailyStatus-> save();
		}

	}

	public function postMeasureRecord(Request $request){
		return "hi";
	}

	public function getHistoricalData(Request $request){
		$result=array(['hello'=>'world'],["test"=>"data"]);
		return json_encode($result);
	}

	//app端不需要login，可用https协议
	/*public function postLogin(Request $request){

	}*/

	public function postRegister(Request $request){

	}

}
