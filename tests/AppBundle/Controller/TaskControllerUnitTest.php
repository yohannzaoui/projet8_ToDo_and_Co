<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 05/01/2019
 * Time: 18:46
 */

namespace Tests\AppBundle\Controller;


use AppBundle\Controller\TaskController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use AppBundle\FormHandler\CreateTaskHandler;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormFactoryInterface;
use PHPUnit\Framework\TestCase;

class TaskControllerUnitTest extends TestCase
{


    public function testTaskListResponse()
    {

        $taskController = new TaskController();

        //$twig = $this->createMock(Environment::class);
        //$twig->method("render")->willReturn("");

        $container = $this->createMock(ContainerInterface::class);
        $container->method("has")->with("templating")->willReturn(true);
        $container->method("get")->with("templating")->willReturn($twig);

        $taskController->setContainer($container);
        $this->assertInstanceOf(Response::class, $taskController->home());
    }

    /**
     * @throws \Exception
     */
    public function testCreateTask()
    {
        $createTaskHandler = $this->createMock(CreateTaskHandler::class);

        $taskController = new TaskController();

        $form = $this->createMock(FormInterface::class);
        $form->method("handleRequest")->willReturn($form);

        $formFactory = $this->createMock(FormFactoryInterface::class);
        $formFactory->method("create")->willReturn($form);

        $router = $this->createMock(RouterInterface::class);
        $router->method("generate")->willReturn("/tasks");

        $request = $this->createMock(Request::class);

        $this->assertInstanceOf(RedirectResponse::class, $taskController->createTask($request, $createTaskHandler));

    }

}