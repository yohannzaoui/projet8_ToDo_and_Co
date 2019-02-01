<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 01/02/2019
 * Time: 17:53
 */

namespace Tests\AppBundle\Controller;


use AppBundle\Controller\UserListController;
use AppBundle\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use PHPUnit\Framework\TestCase;
use Twig\Environment;

/**
 * Class UserListControllerUnitTest
 * @package Tests\AppBundle\Controller
 */
class UserListControllerUnitTest extends TestCase
{
    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function testListUsersResponse()
    {
        $twig = $this->createMock(Environment::class);
        $repository = $this->createMock(UserRepository::class);

        $controller = new UserListController();

        $this->assertInstanceOf(Response::class,
            $controller->listUsers($repository, $twig));
    }
}