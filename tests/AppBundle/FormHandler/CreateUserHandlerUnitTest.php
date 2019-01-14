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
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

/**
 * Class CreateUserHandlerUnitTest
 * @package Tests\AppBundle\FormHandler
 */
class CreateUserHandlerUnitTest extends TestCase
{
    /**
     * @var
     */
    private $repository;
    /**
     * @var
     */
    private $passwordEncoder;
    /**
     * @var
     */
    private $messageFlash;

    /**
     *
     */
    public function setUp()
    {
        $this->repository = $this->createMock(UserRepository::class);
        $this->passwordEncoder = $this->createMock(UserPasswordEncoderInterface::class);
        $this->messageFlash = $this->createMock(Session::class);
    }


    /**
     *
     */
    public function testConstruct()
    {
        $handler = new CreateUserHandler(
            $this->repository,
            $this->passwordEncoder,
            $this->messageFlash
        );

        static::assertInstanceOf(CreateUserHandler::class, $handler);
    }


    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function testHandleIfReturnTrue()
    {
        $form = $this->createMock(FormInterface::class);
        $user = $this->createMock(User::class);

        if ($form->method('isValid')->willReturn(true) && $form->method('isSubmitted')->willReturn(true)) {

            $handler = new CreateUserHandler(
                $this->repository,
                $this->passwordEncoder,
                $this->messageFlash
            );

            $addFlash = $this->createMock(FlashBagInterface::class);
            $addFlash->method('add')->willReturn('test');

            $this->messageFlash->method('getFlashBag')->willReturn($addFlash);

            static::assertSame(true, $handler->handle($form, $user));

        }


    }

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function testHandleIfReturnFalse()
    {
        $form = $this->createMock(FormInterface::class);
        $user = $this->createMock(User::class);

        $handler = new CreateUserHandler(
            $this->repository,
            $this->passwordEncoder,
            $this->messageFlash
        );

        static::assertSame(false, $handler->handle($form, $user));
    }
}