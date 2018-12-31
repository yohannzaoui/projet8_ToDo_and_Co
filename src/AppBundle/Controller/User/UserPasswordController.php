<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 30/12/2018
 * Time: 16:57
 */

namespace AppBundle\Controller\User;


use AppBundle\Entity\User;
use AppBundle\Form\UserPasswordType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UserPasswordController
 * @package AppBundle\Controller\User
 */
class UserPasswordController extends AbstractController
{
    /**
     * @Route(path="/user/password/{id}", name="user_password", methods={"GET", "POST"})
     * @param User $user
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function userPassword(User $user, Request $request)
    {
        $form = $this->createForm(UserPasswordType::class, $user)
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $password = $this->get('security.password_encoder')
                ->encodePassword($user, $user->getPassword());

            $user->setPassword($password);

            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', "Le mot de passe à bien été modifié");

            return $this->redirectToRoute('user_list');
        }

        return $this->render('user/password.html.twig', [
            'form' => $form->createView(),
            'user' => $user
        ]);
    }
}