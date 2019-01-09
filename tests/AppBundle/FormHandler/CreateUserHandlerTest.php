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
use AppBundle\Repository\UserRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Tests\AppBundle\AppWebTestCase;

class CreateUserHandlerTest extends AppWebTestCase
{

    private $messageFlash;

    private $passwordEncoder;

    private $repository;

    public function setUp()
    {
        $this->passwordEncoder = $this->createMock(UserPasswordEncoderInterface::class);
        $this->messageFlash = $this->createMock(SessionInterface::class);
        $this->repository = $this->createMock(UserRepository::class);
    }

    public function testConstruct()
    {
        $createUserHandler = new CreateUserHandler($this->repository, $this->passwordEncoder, $this->messageFlash);

        static::assertInstanceOf(
            CreateUserHandler::class,
            $createUserHandler
        );
    }

    public function testHandlerIfIsTrue()
    {
        $user = $this->createMock(User::class);
        $form = $this->createMock(FormInterface::class);

        $createUserHandler = new CreateUserHandler($this->repository, $this->passwordEncoder, $this->messageFlash);

        static::assertTrue(true, $createUserHandler->handle($form, $user));
    }

    public function testHandlerIfIsFalse()
    {
        $user = $this->createMock(User::class);
        $form = $this->createMock(FormInterface::class);

        $createUserHandler = new CreateUserHandler($this->repository, $this->passwordEncoder, $this->messageFlash);

        static::assertFalse(false, $createUserHandler->handle($form, $user));
    }


}