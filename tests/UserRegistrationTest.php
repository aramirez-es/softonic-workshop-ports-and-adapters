<?php

namespace Domain;

class UserRegistrationTest extends \PHPUnit_Framework_TestCase
{
	public function testItShouldAddAUser()
	{
		$username = "aramirez_";
		$user = new User($username);

		$user_registration = new UserRegistration();
		$user_registration->signUp($username);

		$this->assertThat($user_registration->find($username), $this->equalTo($user));
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

	public function testThatUserCanFollowOtherUsers()
	{
		$base_user		= 'aramirez_';
		$user_to_follow	= 'fiunchinho';

		$user_registration = new UserRegistration();
		$user_registration->signUp($base_user);
		$user_registration->signUp($user_to_follow);

		$user_registration->follow( $base_user, $user_to_follow );
		$this->assertThat( $user_registration->getFollowings( $base_user ),
			$this->contains( $user_registration->find($user_to_follow) ) );
	}
}