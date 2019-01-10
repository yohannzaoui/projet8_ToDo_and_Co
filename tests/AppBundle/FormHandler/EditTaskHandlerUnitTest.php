<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 10/01/2019
 * Time: 17:15
 */

namespace Tests\AppBundle\FormHandler;


use AppBundle\FormHandler\EditTaskHandler;
use AppBundle\Repository\TaskRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\Session;

class EditTaskHandlerUnitTest extends TestCase
{
    private $repository;
    private $messageFlash;

    public function setUp()
    {
        $this->repository = $this->createMock(TaskRepository::class);
        $this->messageFlash = $this->createMock(Session::class);
    }

    public function testHandlerIfReturnTrue()
    {
        $form = $this->createMock(FormInterface::class);

        $handler = new EditTaskHandler(
            $this->repository,
            $this->messageFlash
        );

        static::assertTrue(true, $handler->handle($form));
    }

    public function testHandlerIfReturnFalse()
    {
        $form = $this->createMock(FormInterface::class);

        $handler = new EditTaskHandler(
            $this->repository,
            $this->messageFlash
        );

        static::assertfalse(false, $handler->handle($form));
    }
}