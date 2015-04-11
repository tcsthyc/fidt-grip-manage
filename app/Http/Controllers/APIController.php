<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class APIController extends Controller {

	public function __construct(){
		$this->middleware('customerVerify',['only' => ['postDailyRecord','postMeasureRecord']]);
	}

	public function getTips(){

	}

	public function postDailyRecord(Request $Request){

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
