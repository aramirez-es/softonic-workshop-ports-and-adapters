<?php

namespace Domain\Entity;

class UserTest extends \PHPUnit_Framework_TestCase
{
	public function testThatUserCanFollowOtherUsers()
	{
		$base_user		= new User('aramirez_');
		$user_to_follow	= new User('fiunchinho');

		$base_user->follow( $user_to_follow );
		$this->assertThat( $base_user->getFollowings(), $this->contains( $user_to_follow ) );
	}
}