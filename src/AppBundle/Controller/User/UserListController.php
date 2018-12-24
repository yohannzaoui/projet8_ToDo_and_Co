<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 24/12/2018
 * Time: 13:28
 */

namespace AppBundle\Controller\User;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class UserListController
 * @package AppBundle\Controller\User
 */
class UserListController extends AbstractController
{
    /**
     * @Route(path="/users", name="user_list", methods={"GET"})
     */
    public function listAction()
    {
        $users = $this->getDoctrine()->getRepository('AppBundle:User')->findAll();

        return $this->render('user/list.html.twig', [
            'users' => $users
        ]);
    }
}