<?php

namespace Domain;

class UserRegistration
{
	private $users = array();
	private $followings = array();

	public function signUp($username)
	{
		if ( $this->find( $username ) )
		{
			throw new \InvalidArgumentException( "User $username already exists" );
		}

		$this->users[] = $username;
	}

	public function find($username)
	{
		return in_array($username, $this->users, true) ? $username : null;
	}

	public function follow( $username, $username_to_follow )
	{
		$this->followings[$username][] = $username_to_follow;
	}

	public function getFollowings( $username )
	{
		return $this->followings[$username];
	}
}