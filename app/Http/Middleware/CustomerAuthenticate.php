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
				return APIResponse::errorResult("用户不存在");
			}
			else if(!Hash::check($request->password,$record)){
				return APIResponse::errorResult("密码不正确");
			}			
		}
		else{
			return APIResponse::errorResult("请求格式错误");
		}

		return $next($request);
	}

}
