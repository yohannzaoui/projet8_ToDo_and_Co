<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Class SecurityController
 * @package AppBundle\Controller
 */
class SecurityController extends AbstractController
{

    /**
     * @Route(path="/login", name="login", methods={"GET"})
     * @param AuthenticationUtils $authenticationUtils
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }

    /**
     * @Route(path="/login_check", name="login_check", methods={"POST"})
     */
    public function loginCheck()
    {
        // This code is never executed.
    }

    /**
     * @Route(path="/logout", name="logout", methods={"GET"})
     */
    public function logoutCheck()
    {
        // This code is never executed.
    }
}
