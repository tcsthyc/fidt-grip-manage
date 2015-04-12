<?php namespace App;
class APIResponseGenerator{

	private $succeed;
	private $data;
	private $error;

	public function __construct(){
		$this->$succeed=true;
		$this->$data="";
		$this->error="";
	}

	
	public function suc($suc){
		$this->$succeed=$suc;
		return $this;
	}

	public function data($data){
		$this->$data=$data;
		return $this;
	}

	public function error($err){
		$this->$error=$err;
		return $this;
	}

	public function result(){
		$re=['succeed'=> $this->$succeed, 'data'=> $this->$data, 'error'=> $this->$error];
		return json_encode($re);
	}

	public static function successResult($data){
		$re=['succeed'=> true,'data'=> $data, 'error'=>''];
		return json_encode($re);
	}

	public static function errorResult($err){
		$re=['succeed'=> false, 'data'=> '', 'error'=> $err];
		return json_encode($re);
	}
}
?>