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
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class EditUserHandlerTest extends WebTestCase
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
        $editUserHandler = new EditUserHandler($this->manager, $this->messageFlash);

        static::assertInstanceOf(
            EditUserHandler::class,
            $editUserHandler
        );
    }

    public function testHandlerIfIsTrue()
    {
        $user = $this->createMock(User::class);
        $form = $this->createMock(FormInterface::class);

        $editUserHandler = new EditUserHandler($this->manager, $this->messageFlash);

        static::assertTrue(true, $editUserHandler->handle($form, $user));
    }

    public function testHandlerIfIsFalse()
    {
        $user = $this->createMock(User::class);
        $form = $this->createMock(FormInterface::class);

        $editUserHandler = new EditUserHandler($this->manager, $this->messageFlash);

        static::assertFalse(false, $editUserHandler->handle($form, $user));
    }


}