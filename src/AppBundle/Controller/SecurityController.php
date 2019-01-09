<?php

namespace AppBundle\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Twig\Environment;

/**
 * Class SecurityController
 * @package AppBundle\Controller
 */
class SecurityController
{

    /**
     * @Route(path="/login", name="login", methods={"GET"})
     * @param AuthenticationUtils $authenticationUtils
     * @param Environment $twig
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function login(AuthenticationUtils $authenticationUtils, Environment $twig)
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return new Response($twig->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]), Response::HTTP_OK);
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
