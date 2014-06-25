<?php

namespace Domain;

class UserRegistrationTest extends \PHPUnit_Framework_TestCase
{
	public function testItShouldAddAUser()
	{
		$username = "aramirez_";

		$user_registration = new UserRegistration();
		$user_registration->signUp($username);

		$this->assertThat($user_registration->find($username), $this->equalTo($username));
	}

	public function testItShouldNotFindAUserIfItIsNotRegistered()
	{
		$user_registration = new UserRegistration();
		$this->assertThat($user_registration->find("not-exist"), $this->isEmpty());
	}

	public function testThatRegisteringUserThatAlreadyExistsThrowsException()
	{
		$user_registration = new UserRegistration();
		$user_registration->signUp('aramirez_');
		$this->setExpectedException( 'InvalidArgumentException' );
		$user_registration->signUp('aramirez_');
	}
}