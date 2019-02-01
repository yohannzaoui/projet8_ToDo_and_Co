<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 05/01/2019
 * Time: 18:46
 */

namespace Tests\AppBundle\Controller;

use AppBundle\Controller\TaskController;
use AppBundle\Entity\Task;
use AppBundle\Entity\User;
use AppBundle\Repository\TaskRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use AppBundle\FormHandler\CreateTaskHandler;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Form\FormFactoryInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Twig\Environment;

/**
 * Class TaskControllerUnitTest
 * @package Tests\AppBundle\Controller
 */
class TaskControllerUnitTest extends TestCase
{

    /**
     * @var
     */
    private $repository;
    /**
     * @var
     */
    private $tokenStorage;
    /**
     * @var
     */
    private $twig;
    /**
     * @var
     */
    private $formFactory;
    /**
     * @var
     */
    private $urlGenerator;
    /**
     * @var
     */
    private $messageFlash;
    /**
     * @var
     */
    private $createTaskHandler;
    /**
     * @var
     */
    private $form;

    /**
     * @var
     */
    private $authorization;


    /**
     *
     */
    public function setUp()
    {
        $this->repository = $this->createMock(TaskRepository::class);
        $this->tokenStorage = $this->createMock(TokenStorageInterface::class);
        $this->twig = $this->createMock(Environment::class);
        $this->formFactory = $this->createMock(FormFactoryInterface::class);
        $this->urlGenerator = $this->createMock(UrlGeneratorInterface::class);
        $this->messageFlash = $this->createMock(Session::class);
        $this->createTaskHandler = $this->createMock(CreateTaskHandler::class);
        $this->form = $this->createMock(FormInterface::class);
        $this->authorization = $this->createMock(AuthorizationCheckerInterface::class);
    }


    /**
     *
     */
    public function testConstructor()
    {
        $controller = new TaskController(
            $this->repository,
            $this->tokenStorage,
            $this->twig,
            $this->formFactory,
            $this->urlGenerator,
            $this->messageFlash,
            $this->authorization
        );

        static::assertInstanceOf(TaskController::class, $controller);
    }


    /**
     * @throws \Exception
     */
    public function testCreateTaskIfHandleIsFalse()
    {
        $this->createTaskHandler->method('handle')->willReturn(false);

        $this->form->method("handleRequest")->willReturn($this->form);

        $this->formFactory->method("create")->willReturn($this->form);

        $request = Request::create('/tasks/create', 'GET');

        $taskController = new TaskController($this->repository,
            $this->tokenStorage,
            $this->twig,
            $this->formFactory,
            $this->urlGenerator,
            $this->messageFlash,
            $this->authorization
        );

        $this->assertInstanceOf(Response::class,
            $taskController->createTask($request, $this->createTaskHandler));
    }

    /**
     * @throws \Exception
     */
    public function testCreateTaskIfHandleIsTrue()
    {
        $this->createTaskHandler->method('handle')->willReturn(true);

        $this->form->method("handleRequest")->willReturn($this->form);

        $this->formFactory->method("create")->willReturn($this->form);

        $this->urlGenerator->method('generate')->willReturn('task_list');

        $request = Request::create('/tasks/create', 'GET');

        $taskController = new TaskController($this->repository,
            $this->tokenStorage,
            $this->twig,
            $this->formFactory,
            $this->urlGenerator,
            $this->messageFlash,
            $this->authorization
        );

        $this->assertInstanceOf(RedirectResponse::class,
            $taskController->createTask($request, $this->createTaskHandler));
    }


    /**
     * @throws \Exception
     */
    public function testEditTaskIfHandleIsFalse()
    {
        $this->createTaskHandler->method('handle')->willReturn(false);

        $this->form->method("handleRequest")->willReturn($this->form);

        $this->formFactory->method("create")->willReturn($this->form);

        $request = Request::create('/tasks/edit/{id}', 'GET', ['id'=>50]);

        $taskController = new TaskController($this->repository,
            $this->tokenStorage,
            $this->twig,
            $this->formFactory,
            $this->urlGenerator,
            $this->messageFlash,
            $this->authorization
        );

        $this->assertInstanceOf(Response::class,
            $taskController->createTask($request, $this->createTaskHandler));
    }


    /**
     * @throws \Exception
     */
    public function testEditTaskIfHandleIsTrue()
    {
        $this->createTaskHandler->method('handle')->willReturn(true);

        $this->form->method("handleRequest")->willReturn($this->form);

        $this->formFactory->method("create")->willReturn($this->form);

        $this->urlGenerator->method('generate')->willReturn('task_list');

        $request = Request::create('/tasks/edit/{id}', 'GET', ['id'=>50]);

        $taskController = new TaskController($this->repository,
            $this->tokenStorage,
            $this->twig,
            $this->formFactory,
            $this->urlGenerator,
            $this->messageFlash,
            $this->authorization
        );

        $this->assertInstanceOf(RedirectResponse::class,
            $taskController->createTask($request, $this->createTaskHandler));
    }


    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function testDeleteTaskRedirection()
    {
        $user = $this->createMock(TokenInterface::class);
        $user->method('getUser')->willReturn($user);

        $this->tokenStorage->method('getToken')->willReturn($user);

        $task = $this->createMock(Task::class);

        $this->urlGenerator->method('generate')->willReturn('task_list');

        $addFlash = $this->createMock(FlashBagInterface::class);
        $addFlash->method('add')->willReturn('test');

        $this->messageFlash->method('getFlashBag')->willReturn($addFlash);

        $taskController = new TaskController($this->repository,
            $this->tokenStorage,
            $this->twig,
            $this->formFactory,
            $this->urlGenerator,
            $this->messageFlash,
            $this->authorization
        );

        $this->assertInstanceOf(Response::class,
            $taskController->deleteTask($task));
    }


    /**
     * @throws \Exception
     */
    public function testToggleTaskResponse()
    {
        $user = $this->createMock(TokenInterface::class);
        $user->method('getUser')->willReturn($user);

        $this->tokenStorage->method('getToken')->willReturn($user);

        $task = $this->createMock(Task::class);

        $this->urlGenerator->method('generate')->willReturn('task_list');

        $addFlash = $this->createMock(FlashBagInterface::class);
        $addFlash->method('add')->willReturn('test');

        $this->messageFlash->method('getFlashBag')->willReturn($addFlash);

        $taskController = new TaskController($this->repository,
            $this->tokenStorage,
            $this->twig,
            $this->formFactory,
            $this->urlGenerator,
            $this->messageFlash,
            $this->authorization
        );

        $this->assertInstanceOf(Response::class,
            $taskController->toggleTask($task));
    }

    /**
     * @throws \Exception
     */
    public function testToggleTaskRedirect()
    {
        $task = $this->createMock(Task::class);

        $user = $this->createMock(TokenInterface::class);
        $user->method('getUser')->willReturn($user);

        $this->tokenStorage->method('getToken')->willReturn($user);

        $this->urlGenerator->method('generate')->willReturn('task_list');

        $addFlash = $this->createMock(FlashBagInterface::class);
        $addFlash->method('add')->willReturn('test');

        $this->messageFlash->method('getFlashBag')->willReturn($addFlash);

        $taskController = new TaskController($this->repository,
            $this->tokenStorage,
            $this->twig,
            $this->formFactory,
            $this->urlGenerator,
            $this->messageFlash,
            $this->authorization
        );

        $this->assertInstanceOf(Response::class,
            $taskController->toggleTask($task));
    }
}