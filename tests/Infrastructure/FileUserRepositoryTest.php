<?php

namespace Infrastructure;

use Domain\Entity\User;

class FileUserRepositoryTest extends \PHPUnit_Framework_TestCase
{
	private $database_name;

	protected function setUp()
	{
		$this->database_name = '/tmp/TEST-' . md5( uniqid() );
	}

	protected function tearDown()
	{
		$this->dropDatabase();
	}

	public function testItShouldCreateAFileWhenItIsNotExist()
	{
		$this->dropDatabase();

		$repository = new FileUserRepository($this->database_name);
		$this->assertTrue( is_file( $this->database_name ) );
	}
	
	public function testItShouldAddAUser()
	{
		$username	= 'aramirez_';
		$user		= new User($username);

		$repository = new FileUserRepository($this->database_name);
		$repository->add($user);

		$this->assertThat( $repository->exists($username), $this->equalTo($user) );
	}
	
	public function testItShouldNotExistAUserNotAdded()
	{
		$repository = new FileUserRepository($this->database_name);
		$this->assertThat( $repository->exists( 'not-exist' ), $this->isEmpty() );
	}

	private function dropDatabase()
	{
		@unlink( $this->database_name );
	}
}