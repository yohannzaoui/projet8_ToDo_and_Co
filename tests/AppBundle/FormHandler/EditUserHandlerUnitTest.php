<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 10/01/2019
 * Time: 17:21
 */

namespace Tests\AppBundle\FormHandler;


use AppBundle\FormHandler\EditUserHandler;
use AppBundle\Repository\UserRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Class EditUserHandlerUnitTest
 * @package Tests\AppBundle\FormHandler
 */
class EditUserHandlerUnitTest extends TestCase
{
    /**
     * @var
     */
    private $repository;
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
        $this->messageFlash = $this->createMock(Session::class);
    }

    /**
     *
     */
    public function testConstruct()
    {
        $handler = new EditUserHandler(
            $this->repository,
            $this->messageFlash
        );

        static::assertInstanceOf(EditUserHandler::class, $handler);
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function testHandlerIfReturnTrue()
    {
        $form = $this->createMock(FormInterface::class);

        $handler = new EditUserHandler(
            $this->repository,
            $this->messageFlash
        );

        static::assertTrue(true, $handler->handle($form));
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function testHandlerIfReturnFalse()
    {
        $form = $this->createMock(FormInterface::class);

        $handler = new EditUserHandler(
            $this->repository,
            $this->messageFlash
        );

        static::assertFalse(false, $handler->handle($form));
    }
}