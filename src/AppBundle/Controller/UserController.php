<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 04/01/2019
 * Time: 14:50
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use AppBundle\Form\UserEditType;
use AppBundle\Form\UserPasswordType;

class UserController extends AbstractController
{

    /**
     * @Route(path="/users/create", name="user_create", methods={"GET","POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function createUser(Request $request)
    {
        $user = new User();

        $form = $this->createForm(UserType::class, $user)
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();

            $password = $this->get('security.password_encoder')
                ->encodePassword($user, $user->getPassword());

            $user->setPassword($password);

            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', "L'utilisateur a bien été ajouté.");

            return $this->redirectToRoute('user_list');
        }

        return $this->render('user/create.html.twig', [
            'form' => $form->createView()
        ]);
    }


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


    /**
     * @Route(path="/users/{id}/edit", name="user_edit", methods={"GET","POST"}, requirements={"id"="\d+"})
     * @param User $user
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editUser(User $user, Request $request)
    {
        $form = $this->createForm(UserEditType::class, $user)
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', "L'utilisateur a bien été modifié");

            return $this->redirectToRoute('user_list');
        }

        return $this->render('user/edit.html.twig', [
            'form' => $form->createView(),
            'user' => $user
        ]);
    }


    /**
     * @Route(path="/users", name="user_list", methods={"GET"})
     */
    public function listUsers()
    {
        $users = $this->getDoctrine()
            ->getRepository(User::class)
            ->findAll();

        return $this->render('user/list.html.twig', [
            'users' => $users
        ]);
    }

    /**
     * @Route(path="/user/password/{id}", name="user_password", methods={"GET", "POST"}, requirements={"id"="\d+"})
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