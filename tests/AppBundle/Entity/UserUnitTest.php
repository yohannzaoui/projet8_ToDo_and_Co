<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 12/01/2019
 * Time: 10:01
 */

namespace Tests\AppBundle\Entity;

use AppBundle\Entity\Task;
use AppBundle\Entity\User;
use PHPUnit\Framework\TestCase;

/**
 * Class UserUnitTest
 * @package Tests\AppBundle\Entity
 */
class UserUnitTest extends TestCase
{
    /**
     * @var
     */
    private $user;

    /**
     * @throws \Exception
     */
    public function setUp()
    {
        $this->user = new User();
    }

    /**
     *
     */
    public function testGetUsernameReturn()
    {
        $this->user->setUsername('test');

        static::assertSame('test', $this->user->getUsername());
    }

    /**
     *
     */
    public function testGetPasswordReturn()
    {
        $this->user->setPassword('test');

        static::assertSame('test', $this->user->getPassword());
    }

    /**
     *
     */
    public function testGetEmailReturn()
    {
        $this->user->setEmail('test@email.com');

        static::assertSame('test@email.com', $this->user->getEmail());
    }

    /**
     * @throws \Exception
     */
    public function testGetCreatedAtReturn()
    {
        $date = new \DateTime();

        $this->user->setCreatedAt($date);

        static::assertSame($date, $this->user->getCreatedAt());
    }

    /**
     * @throws \Exception
     */
    public function testGetTaskReturn()
    {
        $task = new Task();

        $this->user->setTask($task);

        static::assertSame($task, $this->user->getTask());
    }

    /**
     *
     */
    public function testGetRolesReturn()
    {
        $this->user->setRoles(['ROLE_USER']);

        static::assertSame(['ROLE_USER'], $this->user->getRoles());
    }

    public function testEraseCredential()
    {
        static::assertSame(null, $this->user->eraseCredentials());
    }
}