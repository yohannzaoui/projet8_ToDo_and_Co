<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 12/01/2019
 * Time: 09:27
 */

namespace Tests\AppBundle\Entity;


use AppBundle\Entity\Task;
use AppBundle\Entity\User;
use PHPUnit\Framework\TestCase;

/**
 * Class TaskUnitTest
 * @package Tests\AppBundle\Entity
 */
class TaskUnitTest extends TestCase
{
    /**
     * @var
     */
    private $task;

    /**
     * @throws \Exception
     */
    public function setUp()
    {
        $this->task = new Task();
    }


    /**
     *
     */
    public function testGetTitleReturn()
    {
        $this->task->setTitle('test');

        static::assertSame('test', $this->task->getTitle());
    }

    /**
     *
     */
    public function testGetContentReturn()
    {
        $this->task->setContent('test');

        static::assertSame('test', $this->task->getContent());
    }

    /**
     *
     */
    public function testIsDoneReturn()
    {
        $this->task->toggle(false);

        static::assertSame(false, $this->task->isDone());
    }

    /**
     * @throws \Exception
     */
    public function testGetUser()
    {
        $user = new User();

        $this->task->setUser($user);

        static::assertSame($user, $this->task->getUser());
    }

    /**
     * @throws \Exception
     */
    public function testGetDateIsDoneReturn()
    {
        $date = new \DateTime();

        $this->task->setDateIsDone($date);

        static::assertSame($date, $this->task->getDateIsDone());
    }

    /**
     * @throws \Exception
     */
    public function testGetCreatedAtReturn()
    {
        $date = new \DateTime();

        $this->task->setCreatedAt($date);

        static::assertSame($date, $this->task->getCreatedAt());
    }

}