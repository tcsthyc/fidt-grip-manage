<?php namespace App\Http\Controllers;

/*
	timezone: PRC
	


*/

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\HealthTip;
use App\Customer;
use App\DailyStatus;
use App\Http\Utils\APIResponseGenerator as APIResponse;

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

		$tipDataArray=HealthTip::forPage($page,$pageSize)-> get()-> toArray();
		foreach ($tipDataArray as $key => $value) {
			$value['content']= json_decode($value['content'],true);
			$tipDataArray[$key] = $value;
		}
		return APIResponse::successResult($tipDataArray);
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
		$customerName=$request->username;
		$customer=Customer::where('name',$customerName);

		$measureRecord= new MeasureRecord;
		$measureRecord-> record_local_time= $request-> recordLocalTime;
		$measureRecord-> total_mvc= $request-> totalMVC;
		$measureRecord-> total_endurance= $request-> totalEndurance;
		$measureRecord-> total_explosive= $request-> totalExplosive;
		$measureRecord-> index_mvc= $request-> indexMVC;
		$measureRecord-> index_endurance= $request-> indexEndurance;
		$measureRecord-> index_explosive= $request-> indexExplosive;
		$measureRecord-> middle_mvc= $request-> middleMVC;
		$measureRecord-> middle_endurance= $request-> middleEndurance;
		$measureRecord-> middle_explosive= $request-> middleExplosive;
		$measureRecord-> ring_mvc= $request-> ringMVC;
		$measureRecord-> ring_endurance= $request-> ringEndurance;
		$measureRecord-> ring_explosive= $request-> ringExplosive;
		$measureRecord-> little_mvc= $request-> littleMVC;
		$measureRecord-> little_endurance= $request-> littleEndurance;
		$measureRecord-> little_explosive= $request-> littleExplosive; 
		$measureRecord-> customer()-> associate($customer);
		$measureRecord-> save();
	}

	public function getHistoricalData(Request $request){
		$result=array(['hello'=>'world'],["test"=>"data"]);
		return json_encode($result);
	}

	//app端不需要login，可用https协议
	/*public function postLogin(Request $request){

	}*/

	public function postRegister(Request $request){
		$customer= new Customer;
		$customer-> name= $request-> name;
		$customer-> password= Hash::make($request->password);
		$customer-> age= $request-> age;
		$customer-> sex= $request-> sex;
		$customer-> height= $request-> height;
		$customer-> weight= $request-> weight;
		$customer-> bfp= $request-> bodyFatPercentage;
		$customer-> save();
	}

	public function getTest(Request $request){
		$ar=[
			'te' => "123",
			'arr' => ['1' => 'word', '2' => 'word2']
		];
		print_r($ar);
		return json_encode($ar);
	}

}
