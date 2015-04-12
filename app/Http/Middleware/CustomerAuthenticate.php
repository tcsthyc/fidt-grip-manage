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
				return APIResponse::errorResult("user does not exist");
			}
			else if( $record!=$request.password ){
				return APIResponse::errorResult("incorrect password");
			}			
		}
		else{
			return APIResponse::errorResult("illegal request format");
		}

		return $next($request);
	}

}
