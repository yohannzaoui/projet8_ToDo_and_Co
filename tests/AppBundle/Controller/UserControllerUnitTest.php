<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 10/01/2019
 * Time: 11:25
 */

namespace Tests\AppBundle\Controller;

use AppBundle\Controller\UserController;
use AppBundle\Entity\User;
use AppBundle\FormHandler\CreateUserHandler;
use AppBundle\Repository\UserRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Twig\Environment;

/**
 * Class UserControllerUnitTest
 * @package Tests\AppBundle\Controller
 */
class UserControllerUnitTest extends TestCase
{

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
    private $repository;
    /**
     * @var
     */
    private $createUserHandler;
    /**
     * @var
     */
    private $form;


    /**
     *
     */
    public function setUp()
    {
        $this->twig = $this->createMock(Environment::class);
        $this->formFactory = $this->createMock(FormFactoryInterface::class);
        $this->urlGenerator = $this->createMock(UrlGeneratorInterface::class);
        $this->repository = $this->createMock(UserRepository::class);
        $this->createUserHandler = $this->createMock(CreateUserHandler::class);
        $this->form = $this->createMock(FormInterface::class);
    }


    /**
     *
     */
    public function testConstructor()
    {
        $controller = new UserController(
            $this->twig,
            $this->formFactory,
            $this->urlGenerator,
            $this->repository
        );

        static::assertInstanceOf(UserController::class, $controller);
    }


    /**
     * @covers \AppBundle\FormHandler\CreateUserHandler::handle
     * @throws \Exception
     */
    public function testCreateUserIfHandleFalse()
    {
        $this->createUserHandler->method('handle')->willReturn(false);

        $this->form->method('handleRequest')->willReturn($this->form);

        $this->formFactory->method('create')->willReturn($this->form);

        $request = Request::create('/tasks/create', 'GET');

        $controller = new UserController(
            $this->twig,
            $this->formFactory,
            $this->urlGenerator,
            $this->repository
        );

        $this->assertInstanceOf(Response::class,
            $controller->createUser($request, $this->createUserHandler));
    }


    /**
     * @throws \Exception
     */
    public function testCreateUserIfHandleTrue()
    {

        $this->createUserHandler->method('handle')->willReturn(true);

        $this->form->method('handleRequest')->willReturn($this->form);

        $this->formFactory->method('create')->willReturn($this->form);

        $this->urlGenerator->method('generate')->willReturn('user_list');

        $request = Request::create('/tasks/create', 'POST');

        $controller = new UserController(
            $this->twig,
            $this->formFactory,
            $this->urlGenerator,
            $this->repository
        );

        $this->assertInstanceOf(RedirectResponse::class,
            $controller->createUser($request, $this->createUserHandler));
    }


    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function testDeleteUserRedirection()
    {
        $user = $this->createMock(User::class);

        $userToken = $this->createMock(TokenInterface::class);
        $userToken->method('getUser')->willReturn($userToken);

        $tokenStorage = $this->createMock(TokenStorageInterface::class);
        $tokenStorage->method('getToken')->willReturn($userToken);

        $this->urlGenerator->method('generate')->willReturn('user_list');

        $addFlash = $this->createMock(FlashBag::class);
        $addFlash->method('add')->willReturn('test');

        $messageFlash = $this->createMock(Session::class);
        $messageFlash->method('getFlashBag')->willReturn($addFlash);

        $controller = new UserController(
            $this->twig,
            $this->formFactory,
            $this->urlGenerator,
            $this->repository
        );

        $this->assertInstanceOf(RedirectResponse::class,
            $controller->deleteUser($user, $tokenStorage, $messageFlash));
    }


    /**
     * @throws \Exception
     */
    public function testEditUserIfHandleIsFalse()
    {
        $this->createUserHandler->method('handle')->willReturn(false);

        $this->form->method('handleRequest')->willReturn($this->form);

        $this->formFactory->method('create')->willReturn($this->form);

        $request = Request::create('/users/{id}/edit', 'GET', ['id'=>50]);

        $controller = new UserController(
            $this->twig,
            $this->formFactory,
            $this->urlGenerator,
            $this->repository
        );

        $this->assertInstanceOf(Response::class,
            $controller->createUser($request, $this->createUserHandler));
    }


    /**
     * @throws \Exception
     */
    public function testEditUserIfHandleTrue()
    {

        $this->createUserHandler->method('handle')->willReturn(true);

        $this->form->method('handleRequest')->willReturn($this->form);

        $this->formFactory->method('create')->willReturn($this->form);

        $this->urlGenerator->method('generate')->willReturn('user_list');

        $request = Request::create('/users/{id}/edit', 'GET', ['id'=>50]);

        $controller = new UserController(
            $this->twig,
            $this->formFactory,
            $this->urlGenerator,
            $this->repository
        );

        $this->assertInstanceOf(RedirectResponse::class,
            $controller->createUser($request, $this->createUserHandler));
    }


    /**
     * @throws \Exception
     */
    public function testEditUserPasswordIfHandleIsFalse()
    {
        $this->createUserHandler->method('handle')->willReturn(false);

        $this->form->method('handleRequest')->willReturn($this->form);

        $this->formFactory->method('create')->willReturn($this->form);

        $request = Request::create('/user/password/{id}', 'GET', ['id'=>50]);

        $controller = new UserController(
            $this->twig,
            $this->formFactory,
            $this->urlGenerator,
            $this->repository
        );

        $this->assertInstanceOf(Response::class,
            $controller->createUser($request, $this->createUserHandler));
    }


    /**
     * @throws \Exception
     */
    public function testEditUserPasswordIfHandleIsTrue()
    {
        $this->createUserHandler->method('handle')->willReturn(true);

        $this->form->method('handleRequest')->willReturn($this->form);

        $this->formFactory->method('create')->willReturn($this->form);

        $this->urlGenerator->method('generate')->willReturn('user_list');

        $request = Request::create('/user/password/{id}', 'GET', ['id'=>50]);

        $controller = new UserController(
            $this->twig,
            $this->formFactory,
            $this->urlGenerator,
            $this->repository
        );

        $this->assertInstanceOf(RedirectResponse::class,
            $controller->createUser($request, $this->createUserHandler));
    }

}