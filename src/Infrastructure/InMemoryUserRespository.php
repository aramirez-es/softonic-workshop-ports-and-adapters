<?php

namespace Infrastructure;

use Domain\Entity\User as UserEntity;
use Domain\Repository\User as UserRespository;

class InMemoryUserRespository implements UserRespository
{
	private $users = array();

	public function add(UserEntity $user)
	{
		$this->users[$user->getUsername()] = $user;
	}

	public function exists($username)
	{
		return isset($this->users[$username]) ? $this->users[$username] : null;
	}
} 