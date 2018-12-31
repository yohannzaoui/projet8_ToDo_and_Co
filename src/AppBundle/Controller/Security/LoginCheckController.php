<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 26/12/2018
 * Time: 21:26
 */

namespace AppBundle\Controller\Security;

use Symfony\Component\Routing\Annotation\Route;

/**
 * Class LoginCheckController
 * @package AppBundle\Controller\Security
 */
class LoginCheckController
{
    /**
     * @Route(path="/login_check", name="login_check", methods={"POST"})
     */
    public function loginCheck()
    {
        // This code is never executed.
    }
}