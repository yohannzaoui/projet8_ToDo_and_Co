<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 01/02/2019
 * Time: 17:48
 */

namespace AppBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Repository\UserRepository;
use Twig\Environment;

/**
 * Class UserListController
 * @package AppBundle\Controller
 */
class UserListController
{
    /**
     * @Route(path="/users", name="user_list", methods={"GET"})
     * @param UserRepository $repository
     * @param Environment $twig
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function listUsers(UserRepository $repository, Environment $twig): Response
    {
        $users = $repository->findAll();

        return new Response($twig->render('user/list.html.twig', [
            'users' => $users
        ]), Response::HTTP_OK);
    }
}