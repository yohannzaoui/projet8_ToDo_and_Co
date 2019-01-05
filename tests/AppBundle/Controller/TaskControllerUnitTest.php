<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 05/01/2019
 * Time: 18:46
 */

namespace Tests\AppBundle\Controller;


use AppBundle\Controller\TaskController;
use AppBundle\FormHandler\TaskHandler;
use PHPUnit\Framework\TestCase;

class TaskControllerUnitTest extends TestCase
{
    public function testConstruct()
    {
        $handler = $this->createMock(TaskHandler::class);

        $taskController = new TaskController($handler);

        $this->assertInstanceOf(TaskController::class, $taskController);
    }

    public function testTaskList()
    {

    }
}