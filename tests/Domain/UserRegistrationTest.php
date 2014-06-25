<?php

namespace Domain;

use Domain\Entity\User;
use Infrastructure\InMemoryUserRespository;

class UserRegistrationTest extends \PHPUnit_Framework_TestCase
{
	private $user_service;

	protected function setUp()
	{
		$this->user_service = new UserRegistration(new InMemoryUserRespository());
	}

	public function testItShouldAddAUser()
	{
		$username = "aramirez_";
		$user = new User($username);

		$this->user_service->signUp($username);

		$this->assertThat($this->user_service->find($username), $this->equalTo($user));
	}

	public function testItShouldNotFindAUserIfItIsNotRegistered()
	{
		$this->assertThat($this->user_service->find("not-exist"), $this->isEmpty());
	}

	public function testThatRegisteringUserThatAlreadyExistsThrowsException()
	{
		$this->user_service->signUp('aramirez_');
		$this->setExpectedException( 'InvalidArgumentException' );
		$this->user_service->signUp('aramirez_');
	}

	public function testThatUserCanFollowOtherUsers()
	{
		$base_user		= 'aramirez_';
		$user_to_follow	= 'fiunchinho';

		$this->user_service->signUp($base_user);
		$this->user_service->signUp($user_to_follow);

		$this->user_service->follow( $base_user, $user_to_follow );

		$this->assertThat( $this->user_service->getFollowings( $base_user ),
			$this->contains( $this->user_service->find($user_to_follow) ) );
	}
}