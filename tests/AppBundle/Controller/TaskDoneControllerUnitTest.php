<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 01/02/2019
 * Time: 16:18
 */

namespace Tests\AppBundle\Controller;


use AppBundle\Controller\TaskDoneController;
use AppBundle\Repository\TaskRepository;
use PHPUnit\Framework\TestCase;
use Twig\Environment;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class TaskDoneControllerUnitTest
 * @package Tests\AppBundle\Controller
 */
class TaskDoneControllerUnitTest extends TestCase
{
    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function testTaskIsDoneResponse()
    {
        $twig = $this->createMock(Environment::class);
        $repository = $this->createMock(TaskRepository::class);

        $taskDoneController = new TaskDoneController();

        $this->assertInstanceOf(Response::class,
            $taskDoneController->taskIsDone($repository, $twig));
    }
}