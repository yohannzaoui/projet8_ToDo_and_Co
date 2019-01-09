<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 05/01/2019
 * Time: 18:46
 */

namespace Tests\AppBundle\Controller;


use AppBundle\Controller\TaskController;
use AppBundle\Entity\User;
use AppBundle\Repository\TaskRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RouterInterface;
use AppBundle\FormHandler\CreateTaskHandler;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Form\FormFactoryInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Twig\Environment;

class TaskControllerUnitTest extends TestCase
{

    /**
     * @var TaskRepository
     */
    private $repository;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * @var SessionInterface
     */
    private $messageFlash;


    public function setUp()
    {
        $this->repository = $this->createMock(TaskRepository::class);
        $this->tokenStorage = $this->createMock(TokenStorageInterface::class);
        $this->twig = $this->createMock(Environment::class);
        $this->formFactory = $this->createMock(FormFactoryInterface::class);
        $this->urlGenerator = $this->createMock(UrlGeneratorInterface::class);
        $this->messageFlash = $this->createMock(SessionInterface::class);
    }


    public function testTaskListResponse()
    {
        $taskController = new TaskController(
            $this->repository,
            $this->tokenStorage,
            $this->twig,
            $this->formFactory,
            $this->urlGenerator,
            $this->messageFlash
            );


        $user = $this->createMock(UserInterface::class);

        $token = $this->createMock(TokenInterface::class);

        $token
            ->method("getUser")
            ->willReturn($user)
        ;

        $tokenStorage = $this->createMock(TokenStorageInterface::class);

        $tokenStorage
            ->method("getToken")
            ->willReturn($token)
        ;

        $this->assertInstanceOf(Response::class, $taskController->tasksList());
    }


    /**
     * @dataProvider dataHandler
     * @throws \Exception
     */
    /*public function testCreateTask($handle, $response)
    {
        $createTaskHandler = $this->createMock(CreateTaskHandler::class);
        $createTaskHandler->method('handle')->willReturn($handle);

        $form = $this->createMock(FormInterface::class);
        $form->method("handleRequest")->willReturn($form);

        $formFactory = $this->createMock(FormFactoryInterface::class);
        $formFactory->method("create")->willReturn($form);

        $urlGenerator = $this->createMock(UrlGeneratorInterface::class);
        $urlGenerator->method('generate')->willReturn('/tasks');

        $request = $this->createMock(Request::class);

        $taskController = new TaskController($this->repository,
            $this->tokenStorage,
            $this->twig,
            $this->formFactory,
            $this->urlGenerator,
            $this->messageFlash
        );

        $this->assertInstanceOf($response, $taskController->createTask($request, $createTaskHandler));

    }*/

    /**
     * @return array
     */
    /*public function dataHandler()
    {
        return [
            [
                "handle" => false,
                "response" => Response::class
            ],
            [
                "handle" => true,
                "response" => RedirectResponse::class
            ],
        ];
    }*/

}