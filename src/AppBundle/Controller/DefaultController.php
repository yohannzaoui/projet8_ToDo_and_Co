<?php

/**
 *
 * @category
 * @package
 * @author   Yohann Zaoui <yohannzaoui@gmail.com>
 * @license
 * @link
 * Created by PhpStorm.
 * Date: 01/02/2019
 * Time: 23:14
 */

declare(strict_types=1);

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

/**
 * Class DefaultController
 *
 * @package AppBundle\Controller
 */
class DefaultController
{
    /**
     * @Route(path="/", name="homepage", methods={"GET"})
     * @param           Environment $twig
     * @return          Response
     * @throws          \Twig_Error_Loader
     * @throws          \Twig_Error_Runtime
     * @throws          \Twig_Error_Syntax
     */
    public function home(Environment $twig)
    {
        return new Response(
            $twig->render('default/index.html.twig'),
            Response::HTTP_OK
        );
    }

}
