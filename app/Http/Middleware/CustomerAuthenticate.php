<?php namespace App\Http\Middleware;

use Closure;
use App\APIResponseGenerator as APIResponse;
use App\Customer

class CustomerAuthenticate {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		$requstObj=json_decode($request);
		if($requstObj && $request.username && $request.password){
			$record=Customer::where('name',$request.username)->pluck('password');
			if(!$record){
				return error_response("user does not exist");
			}
			else if( $record!=$request.password ){
				return error_response("incorrect password");
			}			
		}
		else{
			return error_response("illegal request format");
		}

		return $next($request);
	}

	function error_response($content){
		$apiResponse= new APIResponse;
		return $apiResponse->suc("false")->error($content)->result(); 
	}

}
