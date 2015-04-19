<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Utils\TipModel;

use Illuminate\Http\Request;

use App\HealthTip;
use App\User;

class TipsController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('csrf',['only'=> ['postUpload']]);
	}


	public function getIndex(){
		return redirect(url('tips/all'));
	}
	
	public function getAll(Request $request)
	{
		$page=1;
		if($request->input('page')){
			$page=$request->input('page');
		}
		
		$pageSize=20;

		$tips= HealthTip::with('user') -> limit($pageSize) -> offset(($page-1)*$pageSize) -> orderby('updated_at') -> get();
		return view('grip/showAllTips',['tips' => $tips]);
	}

	public function getUpload(){
		return view('grip/tipUpload');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postUpload(Request $request)
	{
		if($request -> user()){
			$healthTip = new HealthTip;
			$healthTip -> user() -> associate($request -> user());
			$healthTip -> title = $request -> input('title');
			$tipModel = new TipModel($request-> input('question'),$request-> input('answer'));
			$healthTip -> content = $tipModel-> toString();
			$healthTip -> save();
		}
		return redirect(url('tips/all'));
	}

}
