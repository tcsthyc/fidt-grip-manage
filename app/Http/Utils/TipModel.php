<?php namespace App\Http\Utils;
class TipModel{

	public $question;
	public $answer;

	public function TipsModel($q="",$a=""){
		$this->$question=$q;
		$this->$answer=$a;
	}

	public function toString(){
		return $this->toJson();
	}

	public function toJson(){
		$map=["q"=> $this-> $question, "a"=> $this-> $answer];
		return json_encode($map,JSON_UNESCAPED_UNICODE);
	}
}
?>