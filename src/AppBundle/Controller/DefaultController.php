<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DefaultController
 * @package AppBundle\Controller
 */
class DefaultController extends AbstractController
{

    /**
     * @Route(path="/", name="homepage", methods={"GET"})
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function home()
    {
        return $this->render('default/index.html.twig');
    }
}
