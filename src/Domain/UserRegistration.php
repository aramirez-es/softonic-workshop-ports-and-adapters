<?php

namespace Domain;

class UserRegistration
{
	private $users = array();

	public function signUp($username)
	{
		if ( $this->find( $username ) )
		{
			throw new \InvalidArgumentException( "User $username already exists" );
		}

		$this->users[$username] = new User($username);
	}

	public function find($username)
	{
		return isset($this->users[$username]) ? $this->users[$username] : null;
	}

	public function follow( $username, $username_to_follow )
	{
		$this->find($username)->follow($this->find($username_to_follow));
	}

	public function getFollowings( $username )
	{
		return $this->find($username)->getFollowings();
	}
}