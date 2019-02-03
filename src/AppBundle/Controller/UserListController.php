<?php

/**
 *
 * @category
 * @package
 * @author   Yohann Zaoui <yohannzaoui@gmail.com>
 * @license
 * @link
 * Created by PhpStorm.
 * Date: 01/02/2019
 * Time: 23:14
 */

declare(strict_types=1);

namespace AppBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Repository\UserRepository;
use Twig\Environment;

/**
 * Class UserListController
 *
 * @package AppBundle\Controller
 */
class UserListController
{
    /**
     * @Route(path="/users", name="user_list", methods={"GET"})
     * @param                UserRepository $repository
     * @param                Environment    $twig
     * @return               Response
     * @throws               \Twig_Error_Loader
     * @throws               \Twig_Error_Runtime
     * @throws               \Twig_Error_Syntax
     */
    public function usersList(UserRepository $repository, Environment $twig)
    {
        $users = $repository->findAll();

        return new Response(
            $twig->render(
                'user/list.html.twig', [
                'users' => $users
                ]
            ), Response::HTTP_OK
        );
    }
}
