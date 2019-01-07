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
use AppBundle\Service\PasswordEncoderService;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class EditPasswordHandlerTest extends WebTestCase
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
        $editPasswordHandler = new EditPasswordHandler($this->manager, $this->passwordEncoder, $this->messageFlash);

        static::assertInstanceOf(
            EditPasswordHandler::class,
            $editPasswordHandler
        );
    }

    public function testHandlerIfIsTrue()
    {
        $user = $this->createMock(User::class);
        $form = $this->createMock(FormInterface::class);

        $editPasswordHandler = new EditPasswordHandler($this->manager, $this->passwordEncoder, $this->messageFlash);

        static::assertTrue(true, $editPasswordHandler->handle($form, $user));
    }

    public function testHandlerIfIsFalse()
    {
        $user = $this->createMock(User::class);
        $form = $this->createMock(FormInterface::class);

        $editPasswordHandler = new EditPasswordHandler($this->manager, $this->passwordEncoder, $this->messageFlash);

        static::assertFalse(false, $editPasswordHandler->handle($form, $user));
    }


}