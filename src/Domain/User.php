<?php

namespace Domain;

class User
{
	private $username;
	private $followings = array();

	public function __construct($username)
	{
		$this->username = $username;
	}

	public function getUsername()
	{
		return $this->username;
	}

	public function getFollowings()
	{
		return $this->followings;
	}

	public function follow(User $user)
	{
		$this->followings[] = $user;
	}
} 