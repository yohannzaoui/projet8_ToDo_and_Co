<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 26/12/2018
 * Time: 21:27
 */

namespace AppBundle\Controller\Security;

use Symfony\Component\Routing\Annotation\Route;

/**
 * Class LogoutController
 * @package AppBundle\Controller\Security
 */
class LogoutController
{
    /**
     * @Route(path="/logout", name="logout", methods={"GET"})
     */
    public function logoutCheck()
    {
        // This code is never executed.
    }
}