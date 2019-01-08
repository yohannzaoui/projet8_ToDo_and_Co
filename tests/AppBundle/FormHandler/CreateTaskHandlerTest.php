<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 06/01/2019
 * Time: 12:36
 */

namespace Tests\AppBundle\FormHandler;


use AppBundle\Entity\Task;
use AppBundle\FormHandler\CreateTaskHandler;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class CreateTaskHandlerTest extends WebTestCase
{
    private $manager;

    private $tokenStorage;

    private $messageFlash;

    public function setUp()
    {
        $this->manager = $this->createMock(ObjectManager::class);
        $this->tokenStorage= $this->createMock(TokenStorageInterface::class);
        $this->messageFlash = $this->createMock(SessionInterface::class);
    }

    public function testConstruct()
    {
        $createTaskHandler = new CreateTaskHandler($this->manager, $this->tokenStorage, $this->messageFlash);

        static::assertInstanceOf(
            CreateTaskHandler::class,
            $createTaskHandler
        );
    }

    public function testHandlerIfIsTrue()
    {
        $task = $this->createMock(Task::class);
        $form = $this->createMock(FormInterface::class);

        $createTaskHandler = new CreateTaskHandler($this->manager, $this->tokenStorage, $this->messageFlash);

        static::assertTrue(true, $createTaskHandler->handle($form, $task));
    }

    public function testHandlerIfIsFalse()
    {
        $task = $this->createMock(Task::class);
        $form = $this->createMock(FormInterface::class);

        $createTaskHandler = new CreateTaskHandler($this->manager, $this->tokenStorage, $this->messageFlash);

        static::assertFalse(false, $createTaskHandler->handle($form, $task));
    }
}