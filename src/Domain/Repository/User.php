<?php

namespace Domain\Repository;

use Domain\Entity\User as UserEntity;

interface User
{
	public function add( UserEntity $user );
	public function exists( $username );
	public function findAll();
}