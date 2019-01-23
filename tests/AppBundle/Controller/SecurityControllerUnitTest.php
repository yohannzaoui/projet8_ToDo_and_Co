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
use Twig\Environment;

/**
 * Class SecurityControllerUnitTest
 * @package Tests\AppBundle\Controller
 */
class SecurityControllerUnitTest extends TestCase
{
    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function testLoginResponse()
    {
        $authentication = $this->createMock(AuthenticationUtils::class);
        $twig = $this->createMock(Environment::class);

        $controller = new SecurityController();

        static::assertInstanceOf(
            Response::class,
            $controller->login($authentication, $twig)
        );
    }

}