<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 06/01/2019
 * Time: 12:21
 */

namespace Tests\AppBundle\FormHandler;


use AppBundle\Entity\User;
use AppBundle\FormHandler\EditUserHandler;
use AppBundle\Repository\UserRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Tests\AppBundle\AppWebTestCase;

class EditUserHandlerTest extends AppWebTestCase
{

    private $messageFlash;
    private $repository;


    public function setUp()
    {
        $this->messageFlash = $this->createMock(SessionInterface::class);
        $this->repository = $this->createMock(UserRepository::class);
    }

    public function testConstruct()
    {
        $editUserHandler = new EditUserHandler($this->repository, $this->messageFlash);

        static::assertInstanceOf(
            EditUserHandler::class,
            $editUserHandler
        );
    }

    public function testHandlerIfIsTrue()
    {
        $user = $this->createMock(User::class);
        $form = $this->createMock(FormInterface::class);

        $editUserHandler = new EditUserHandler($this->repository, $this->messageFlash);

        static::assertTrue(true, $editUserHandler->handle($form, $user));
    }

    public function testHandlerIfIsFalse()
    {
        $user = $this->createMock(User::class);
        $form = $this->createMock(FormInterface::class);

        $editUserHandler = new EditUserHandler($this->repository, $this->messageFlash);

        static::assertFalse(false, $editUserHandler->handle($form, $user));
    }


}