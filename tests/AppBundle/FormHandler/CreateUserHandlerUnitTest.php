<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 10/01/2019
 * Time: 17:03
 */

namespace Tests\AppBundle\FormHandler;


use AppBundle\Entity\User;
use AppBundle\FormHandler\CreateUserHandler;
use AppBundle\Repository\UserRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class CreateUserHandlerUnitTest extends TestCase
{
    private $repository;
    private $passwordEncoder;
    private $messageFlash;

    public function setUp()
    {
        $this->repository = $this->createMock(UserRepository::class);
        $this->passwordEncoder = $this->createMock(UserPasswordEncoderInterface::class);
        $this->messageFlash = $this->createMock(Session::class);
    }

    public function testHandleIfReturnTrue()
    {
        $form = $this->createMock(FormInterface::class);
        $user = $this->createMock(User::class);

        $handler = new CreateUserHandler(
            $this->repository,
            $this->passwordEncoder,
            $this->messageFlash
        );

        static::assertTrue(true, $handler->handle($form, $user));
    }

    public function testHandleIfReturnFalse()
    {
        $form = $this->createMock(FormInterface::class);
        $user = $this->createMock(User::class);

        $handler = new CreateUserHandler(
            $this->repository,
            $this->passwordEncoder,
            $this->messageFlash
        );

        static::assertFalse(false, $handler->handle($form, $user));
    }
}