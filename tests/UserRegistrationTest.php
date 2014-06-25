<?php

namespace Domain;

class UserRegistrationTest extends \PHPUnit_Framework_TestCase
{
	public function testItShouldAddAUser()
	{
		$username = "aramirez_";

		$user_registration = new UserRegistration();
		$user_registration->signUp($username);

		$this->assertThat($username, $this->equalTo($user_registration->find($username)));
	}
}