<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 01/02/2019
 * Time: 16:07
 */

namespace Tests\AppBundle\Controller;


use AppBundle\Controller\TaskListController;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Repository\TaskRepository;
use PHPUnit\Framework\TestCase;
use Twig\Environment;

/**
 * Class TaskListControllerUnitTest
 * @package Tests\AppBundle\Controller
 */
class TaskListControllerUnitTest extends TestCase
{
    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function testTaskListResponse()
    {
        $twig = $this->createMock(Environment::class);
        $repository = $this->createMock(TaskRepository::class);

        $taskController = new TaskListController();

        $this->assertInstanceOf(Response::class,
            $taskController->tasksList($repository, $twig));
    }
}