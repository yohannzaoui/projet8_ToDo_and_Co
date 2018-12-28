<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 24/12/2018
 * Time: 13:30
 */

namespace AppBundle\Controller\User;

use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class UserCreateController
 * @package AppBundle\Controller\User
 */
class UserCreateController extends AbstractController
{
    /**
     * @Route(path="/users/create", name="user_create", methods={"GET","POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function createAction(Request $request)
    {
        $user = new User();

        $form = $this->createForm(UserType::class, $user)
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $password = $this->get('security.password_encoder')
                ->encodePassword($user, $user->getPassword());

            $user->setPassword($password);

            $em->persist($user);
            $em->flush();

            $this->addFlash('success', "L'utilisateur a bien été ajouté.");

            return $this->redirectToRoute('user_list');
        }

        return $this->render('user/create.html.twig', [
            'form' => $form->createView()
        ]);
    }
}