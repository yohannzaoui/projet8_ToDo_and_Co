<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 06/01/2019
 * Time: 12:36
 */

namespace Tests\AppBundle\FormHandler;


use AppBundle\Entity\Task;
use AppBundle\FormHandler\EditTaskHandler;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class EditTaskHandlerTest extends WebTestCase
{
    private $manager;

    private $messageFlash;

    public function setUp()
    {
        $this->manager = $this->createMock(ObjectManager::class);
        $this->messageFlash = $this->createMock(SessionInterface::class);
    }

    public function testConstruct()
    {
        $editTaskHandler = new EditTaskHandler($this->manager, $this->messageFlash);

        static::assertInstanceOf(
            EditTaskHandler::class,
            $editTaskHandler
        );
    }

    public function testHandlerIfIsTrue()
    {
        $task = $this->createMock(Task::class);
        $form = $this->createMock(FormInterface::class);

        $editTaskHandler = new EditTaskHandler($this->manager, $this->messageFlash);

        static::assertTrue(true, $editTaskHandler->handle($form, $task));
    }

    public function testHandlerIfIsFalse()
    {
        $task = $this->createMock(Task::class);
        $form = $this->createMock(FormInterface::class);

        $editTaskHandler = new EditTaskHandler($this->manager, $this->messageFlash);

        static::assertFalse(false, $editTaskHandler->handle($form, $task));
    }
}