<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 27/12/2018
 * Time: 22:08
 */

namespace AppBundle\Controller\User;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UserDeleteController
 * @package AppBundle\Controller\User
 */
class UserDeleteController extends AbstractController
{
    /**
     * @Route(path="/delete/user/{id}", name="user_delete", methods={"GET"}, requirements={"id"="\d+"})
     * @param User $user
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteUser(User $user)
    {
        if ($user != $this->getUser()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();

            $this->addFlash('success', "L'utilisateur a bien été supprimée.");

            return $this->redirectToRoute('user_list');
        }

        $this->addFlash('success', "Impossible de supprimer votre propre compte.");

        return $this->redirectToRoute('user_list');
    }
}