<?php

declare(strict_types=1);

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

/**
 * Class DefaultController
 * @package AppBundle\Controller
 */
class DefaultController
{
    /**
     * @Route(path="/", name="homepage", methods={"GET"})
     * @param Environment $twig
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function home(Environment $twig): Response
    {
        return new Response($twig->render('default/index.html.twig'),
            Response::HTTP_OK);
    }

}
