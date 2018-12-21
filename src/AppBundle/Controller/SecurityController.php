<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class SecurityController
 * @package AppBundle\Controller
 */
class SecurityController extends AbstractController
{


    /**
     * @Route(
     *     path="/login",
     *     name="login",
     *     methods={"GET"}
     *     )
     *
     * @return Response
     */
    public function loginAction()
    {
        $authenticationUtils = $this->get('security.authentication_utils');
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }

    /**
     * @Route(
     *     path="/login_check",
     *     name="login_check",
     *     methods={"POST"}
     *     )
     */
    public function loginCheck()
    {
        // This code is never executed.
    }

    /**
     * @Route(
     *     path="/logout",
     *     name="logout",
     *     methods={"GET"}
     *     )
     */
    public function logoutCheck()
    {
        // This code is never executed.
    }
}
