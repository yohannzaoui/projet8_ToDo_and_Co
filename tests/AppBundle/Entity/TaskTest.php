<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 05/01/2019
 * Time: 13:03
 */

namespace Tests\AppBundle\Entity;


use AppBundle\Entity\Task;
use PHPUnit\Framework\TestCase;

class TaskTest extends TestCase
{
    private $task;

    public function setUp()
    {
        $this->task = new Task();
    }

    public function testGetTitleIfIsString()
    {
        $this->task->setTitle('title');
        $result = $this->task->getTitle();
        $this->assertSame('title', $result);
    }

    public function testGetContentIfIsString()
    {
        $this->task->setContent('content');
        $result = $this->task->getContent();
        $this->assertSame('content', $result);
    }
}