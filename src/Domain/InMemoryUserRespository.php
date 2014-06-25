<?php

namespace Domain;


class InMemoryUserRespository
{
	private $users = array();

	public function add(User $user)
	{
		$this->users[$user->getUsername()] = $user;
	}

	public function exists($username)
	{
		return isset($this->users[$username]) ? $this->users[$username] : null;
	}
} 