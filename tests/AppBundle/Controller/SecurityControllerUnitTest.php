<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 07/01/2019
 * Time: 20:25
 */

namespace Tests\AppBundle\Controller;

use AppBundle\Controller\SecurityController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use PHPUnit\Framework\TestCase;

class SecurityControllerUnitTest extends TestCase
{
    public function testLoginResponse()
    {
        $authentication = $this->createMock(AuthenticationUtils::class);

        $securityController = new SecurityController();

        static::assertInstanceOf(
            Response::class,
            $securityController->login($authentication)
        );
    }
}