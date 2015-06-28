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
        if($customer){
            print_r($customer);
            echo "<p>";
            print_r($customer->first());
        }
        print_r($request);
        // $customer = Customer::where(name.)
		return "test api for api/user";
	}

	public function postLogin(Request $request){
        $customer = Customer::where('name',$request->username)->toArray();
        return APIResponse::successResult($customer);
	}

	public function postRegister(Request $request){
        $customer = Customer::where('name',$request->username);
        if($customer){
            return APIResponse::errorResult('用户名已存在');
        }

        try{
    		$customer= new Customer;
    		$customer-> name= $request-> username;
    		$customer-> password= Hash::make($request->password);
    		$customer-> age= $request-> age;
    		$customer-> sex= $request-> sex;
    		$customer-> height= $request-> height;
    		$customer-> weight= $request-> weight;
    		$customer-> bfp= $request-> bodyFatPercentage;
            $customer-> phone= $request-> telephone;
    		$customer-> save();
            return APIResponse::successResult('');
        }
        catch(Exception $e){
            return APIResponse::errorResult('服务器发生错误');
        }

	}
}
