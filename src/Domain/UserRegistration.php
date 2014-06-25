<?php

namespace Domain;

use Domain\Entity\User;
use Domain\Repository\User as UserRepository;

class UserRegistration
{
	private $user_repository;

	public function __construct(UserRepository $user_repository)
	{
		$this->user_repository = $user_repository;
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

	public function listUsers()
	{
		return $this->user_repository->findAll();
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