<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class GripDataController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
	}

	public function getIndex(){
		return redirect(url('data/all'));
	}

	public function getAll(Request $request){
		$page = 1;
		if($request->input('page')){
			$page=$request->input('page');
		}
		$pageSize=20;
	}

}
