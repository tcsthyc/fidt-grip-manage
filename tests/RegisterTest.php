<?php

class RegisterTest extends TestCase {

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testBasicExample()
	{
		$response = $this->call('Post', '/api/register',['username'=>'hyc','password'=>'test','age'=>'10','sex'=>'male','height'=>'190','weight'=>'100','bfp'=>'0.11']);

		// $this->assertRedirectedToAction('APIController@postRegister');
		$this->assertSessionHas('succeed');
	}

}
