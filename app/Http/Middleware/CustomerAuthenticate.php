<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Hash;
use App\Http\Utils\APIResponseGenerator as APIResponse;
use App\Customer;

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
		if($request && $request->username && $request->password){
			$record=Customer::where('name',$request->username)->pluck('password');
			if(!$record){
				return APIResponse::errorResult("user does not exist");
			}
			else if(!Hash::check($request->password,$record)){
				return APIResponse::errorResult("incorrect password");
			}			
		}
		else{
			return APIResponse::errorResult("illegal request format");
		}

		return $next($request);
	}

}
