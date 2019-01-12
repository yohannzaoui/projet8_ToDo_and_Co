<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 10/01/2019
 * Time: 16:29
 */

namespace Tests\AppBundle\FormHandler;


use AppBundle\Entity\Task;
use AppBundle\FormHandler\CreateTaskHandler;
use AppBundle\Repository\TaskRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class CreateTaskHandlerUnitTest extends TestCase
{

    private $repository;
    private $tokenStorage;
    private $messageFlash;

    public function setUp()
    {
        $this->repository = $this->createMock(TaskRepository::class);
        $this->tokenStorage = $this->createMock(TokenStorageInterface::class);
        $this->messageFlash = $this->createMock(Session::class);
    }

    public function testConstruct()
    {
        $handler = new CreateTaskHandler(
            $this->repository,
            $this->tokenStorage,
            $this->messageFlash
        );

        static::assertInstanceOf(CreateTaskHandler::class, $handler);
    }

    public function testHandleIfReturnTrue()
    {
        $form = $this->createMock(FormInterface::class);
        $task = $this->createMock(Task::class);

        $handler = new CreateTaskHandler(
            $this->repository,
            $this->tokenStorage,
            $this->messageFlash
        );

        static::assertTrue(true, $handler->handle($form, $task));
    }

    public function testHandleIfReturnFalse()
    {
        $form = $this->createMock(FormInterface::class);
        $task = $this->createMock(Task::class);

        $handler = new CreateTaskHandler(
            $this->repository,
            $this->tokenStorage,
            $this->messageFlash
        );

        static::assertFalse(false, $handler->handle($form, $task));
    }
}