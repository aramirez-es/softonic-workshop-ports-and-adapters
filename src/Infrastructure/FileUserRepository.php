<?php

namespace Infrastructure;

use Domain\Entity\User as UserEntity;
use Domain\Repository\User as UserRespository;

class FileUserRepository implements UserRespository
{
	private $database;

	public function __construct($database)
	{
		$this->database = $database;

		if ( !is_file($this->database) )
		{
			touch($this->database);
			chmod($this->database, 0777);
		}
	}

	public function add(UserEntity $user)
	{
		$users = unserialize(@file_get_contents($this->database));
		$users[$user->getUsername()] = $user;
		@file_put_contents( $this->database, serialize($users) );
	}

	public function exists($username)
	{
		$users = unserialize(@file_get_contents($this->database));
		return isset($users[$username]) ? $users[$username] : null;
	}

	public function findAll()
	{
		return unserialize(@file_get_contents($this->database));
	}
} 