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
use AppBundle\Repository\TaskRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Tests\AppBundle\AppWebTestCase;

class EditTaskHandlerTest extends AppWebTestCase
{

    private $messageFlash;
    private $repository;

    public function setUp()
    {
        $this->messageFlash = $this->createMock(SessionInterface::class);
        $this->repository = $this->createMock(TaskRepository::class);
    }

    public function testConstruct()
    {
        $editTaskHandler = new EditTaskHandler($this->repository, $this->messageFlash);

        static::assertInstanceOf(
            EditTaskHandler::class,
            $editTaskHandler
        );
    }

    public function testHandlerIfIsTrue()
    {
        $task = $this->createMock(Task::class);
        $form = $this->createMock(FormInterface::class);

        $editTaskHandler = new EditTaskHandler($this->repository, $this->messageFlash);

        static::assertTrue(true, $editTaskHandler->handle($form, $task));
    }

    public function testHandlerIfIsFalse()
    {
        $task = $this->createMock(Task::class);
        $form = $this->createMock(FormInterface::class);

        $editTaskHandler = new EditTaskHandler($this->repository, $this->messageFlash);

        static::assertFalse(false, $editTaskHandler->handle($form, $task));
    }
}