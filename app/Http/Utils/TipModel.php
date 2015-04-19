<?php namespace App\Http\Utils;
class TipModel{

	public $question;
	public $answer;

	public function __construct($q="", $a=""){
		$this-> question= $q;
		$this-> answer= $a;
	}

	public function init($q="",$a=""){
		$this-> question=$q;
		$this-> answer=$a;
	}

	public static function instance($q, $a){
		$tipModel= new TipModel;
		$tipModel-> question= $q;
		$tipModel-> answer= $a;
		return $tipModel;
	}

	public function toString(){
		return $this->toJson();
	}

	public function toJson(){
		$map=["q"=> $this-> question, "a"=> $this-> answer];
		return json_encode($map,JSON_UNESCAPED_UNICODE);
	}
}
?>