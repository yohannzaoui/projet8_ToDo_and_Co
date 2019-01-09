<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 06/01/2019
 * Time: 12:36
 */

namespace Tests\AppBundle\FormHandler;



use AppBundle\Repository\TaskRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Tests\AppBundle\AppWebTestCase;
use AppBundle\FormHandler\CreateTaskHandler;

class CreateTaskHandlerTest extends AppWebTestCase
{

    private $tokenStorage;

    private $messageFlash;

    private $repository;

    public function setUp()
    {
        $this->tokenStorage= $this->createMock(TokenStorageInterface::class);
        $this->messageFlash = $this->createMock(SessionInterface::class);
        $this->repository = $this->createMock(TaskRepository::class);
    }

    public function testConstruct()
    {
        $createTaskHandler = new CreateTaskHandler($this->repository, $this->tokenStorage, $this->messageFlash);

        static::assertInstanceOf(
            CreateTaskHandler::class,
            $createTaskHandler
        );
    }

    /*public function testHandlerIfIsTrue()
    {
        $this->logIn();

        $task = $this->createMock(Task::class);
        $form = $this->createMock(FormInterface::class);

        $createTaskHandler = new CreateTaskHandler($this->repository, $this->tokenStorage, $this->messageFlash);

        static::assertTrue(true, $createTaskHandler->handle($form, $task));
    }

    public function testHandlerIfIsFalse()
    {
        $this->logIn();

        $task = $this->createMock(Task::class);
        $form = $this->createMock(FormInterface::class);

        $createTaskHandler = new CreateTaskHandler($this->repository, $this->tokenStorage, $this->messageFlash);

        static::assertFalse(false, $createTaskHandler->handle($form, $task));
    }*/
}