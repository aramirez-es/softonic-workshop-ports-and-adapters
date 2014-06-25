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

		$this->users[] = $username;
	}

	public function find($username)
	{
		return in_array($username, $this->users, true) ? $username : null;
	}
} 