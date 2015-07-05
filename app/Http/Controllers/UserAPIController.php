<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\HealthTip;
use App\Customer;
use App\DailyStatus;
use App\Http\Utils\APIResponseGenerator as APIResponse;

class UserAPIController extends Controller {
	public function __construct(){
		$this->middleware('customerVerify',['only' => ['postLogin','postUpdate']]);
	}

	public function getTest(Request $request){
        $customer = Customer::where('name',$request->username);
        if($customer->first()){
            print_r($customer);
        }
		return "test api for api/user";
	}

	public function postLogin(Request $request){
        $customer = Customer::where('name',$request->username)->first()->toArray();
        return APIResponse::successResult($customer);
	}

	public function postRegister(Request $request){
        $customer = Customer::where('name',$request->username)->first();
        if($customer){
            return APIResponse::errorResult('用户名已存在');
        }

        try{
    		$customer= new Customer;
    		$customer-> name= $request-> username;
    		$customer-> password= Hash::make($request->password);
    		$customer-> age= $request->age? $request->age: 0;
    		$customer-> sex= $request->sex? $request->sex: 0;
    		$customer-> height= $request->height? $request->height: 0;
    		$customer-> weight= $request->weight? $request->weight: 0;
    		$customer-> bfp= $request->bodyFatPercentage?$request->bodyFatPercentage:0.0;
            $customer-> telephone= $request->telephone;
            $customer-> avatar= $request->avatar?$request->avatar:"";
    		$customer-> save();
            return APIResponse::successResult($customer->toArray());
        }
        catch(Exception $e){
            return APIResponse::errorResult('服务器发生错误');
        }

	}

    public function postUpdate(Request $request){
        try{
            if($request->uid){
                $customer = Customer::find($request->uid);
            }
            else{
                $customer = Customer::where('name',$request->username)->first();
            }
            
            if($request->age) $customer->age=$request->age;
            if($request->sex) $customer->sex=$request->sex;
            if($request->height) $customer->height=$request->height;
            if($request->weight) $customer->weight=$request->weight;
            if($request->bfp) $customer->bfp=$request->bfp;
            if($request->telephone) $customer->telephone=$request->telephone;
            if($request->avatar) $customer->avatar=$request->avatar;
            $customer->save();

            return APIResponse::successResult($customer);
        }
        catch(Exception $e){
            return APIResponse::errorResult('服务器发生错误');
        }
    }
}
