<?php

namespace Domain;

use Domain\Entity\User;
use Infrastructure\InMemoryUserRespository;

class UserRegistration
{
	private $user_repository;

	public function __construct()
	{
		$this->user_repository = new InMemoryUserRespository();
	}

	public function signUp($username)
	{
		if ( $this->find( $username ) )
		{
			throw new \InvalidArgumentException( "User $username already exists" );
		}

		$this->user_repository->add( new User($username) );
	}

	public function find($username)
	{
		return $this->user_repository->exists($username);
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