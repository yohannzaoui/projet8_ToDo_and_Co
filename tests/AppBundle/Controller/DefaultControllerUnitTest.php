<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 08/01/2019
 * Time: 11:24
 */

namespace Tests\AppBundle\Controller;

use AppBundle\Controller\DefaultController;
use Twig\Environment;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;
use PHPUnit\Framework\TestCase;

class DefaultControllerUnitTest extends TestCase
{
    public function testHomeResponse()
    {
        $controller = new DefaultController();

        $twig = $this->createMock(Environment::class);
        $twig->method("render")->willReturn("");

        $container = $this->createMock(ContainerInterface::class);
        $container->method("has")->with("templating")->willReturn(true);
        $container->method("get")->with("templating")->willReturn($twig);

        $controller->setContainer($container);
        $this->assertInstanceOf(Response::class, $controller->home());
    }
}