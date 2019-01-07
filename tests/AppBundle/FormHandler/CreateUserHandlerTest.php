<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 06/01/2019
 * Time: 12:21
 */

namespace Tests\AppBundle\FormHandler;


use AppBundle\Entity\User;
use AppBundle\FormHandler\CreateUserHandler;
use AppBundle\Service\PasswordEncoderService;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CreateUserHandlerTest extends WebTestCase
{

    private $manager;

    private $messageFlash;

    private $passwordEncoder;

    public function setUp()
    {
        $this->manager = $this->createMock(ObjectManager::class);
        $this->passwordEncoder = $this->createMock(PasswordEncoderService::class);
        $this->messageFlash = $this->createMock(SessionInterface::class);
    }

    public function testConstruct()
    {
        $createUserHandler = new CreateUserHandler($this->manager, $this->passwordEncoder, $this->messageFlash);

        static::assertInstanceOf(
            CreateUserHandler::class,
            $createUserHandler
        );
    }

    public function testHandlerIfIsTrue()
    {
        $user = $this->createMock(User::class);
        $form = $this->createMock(FormInterface::class);

        $createUserHandler = new CreateUserHandler($this->manager, $this->passwordEncoder, $this->messageFlash);

        static::assertTrue(true, $createUserHandler->handle($form, $user));
    }

    public function testHandlerIfIsFalse()
    {
        $user = $this->createMock(User::class);
        $form = $this->createMock(FormInterface::class);

        $createUserHandler = new CreateUserHandler($this->manager, $this->passwordEncoder, $this->messageFlash);

        static::assertFalse(false, $createUserHandler->handle($form, $user));
    }


}