<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 06/01/2019
 * Time: 12:21
 */

namespace Tests\AppBundle\FormHandler;


use AppBundle\Entity\User;
use AppBundle\FormHandler\EditPasswordHandler;
use AppBundle\Repository\UserRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Tests\AppBundle\AppWebTestCase;

class EditPasswordHandlerTest extends AppWebTestCase
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
        $editPasswordHandler = new EditPasswordHandler(
            $this->repository,
            $this->passwordEncoder,
            $this->messageFlash);

        static::assertInstanceOf(
            EditPasswordHandler::class,
            $editPasswordHandler
        );
    }

    public function testHandlerIfIsTrue()
    {
        $user = $this->createMock(User::class);
        $form = $this->createMock(FormInterface::class);

        $editPasswordHandler = new EditPasswordHandler(
            $this->repository,
            $this->passwordEncoder,
            $this->messageFlash
        );

        static::assertTrue(true, $editPasswordHandler->handle($form, $user));
    }

    public function testHandlerIfIsFalse()
    {
        $user = $this->createMock(User::class);
        $form = $this->createMock(FormInterface::class);

        $editPasswordHandler = new EditPasswordHandler(
            $this->repository,
            $this->passwordEncoder,
            $this->messageFlash
        );

        static::assertFalse(false, $editPasswordHandler->handle($form, $user));
    }


}