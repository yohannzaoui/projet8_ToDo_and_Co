<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 06/01/2019
 * Time: 09:47
 */

namespace AppBundle\Service;


use AppBundle\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class PasswordEncoderService
 * @package AppBundle\Service
 */
class PasswordEncoderService
{

    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * @var User
     */
    private $user;

    /**
     * PasswordEncoderService constructor.
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param User $user
     */
    public function __construct(
        UserPasswordEncoderInterface $passwordEncoder,
        User $user
    ) {
        $this->passwordEncoder = $passwordEncoder;
        $this->user = $user;
    }

    /**
     * @param $plainPassword
     * @return string
     */
    public function encoder($plainPassword)
    {
        return $this->passwordEncoder
            ->encodePassword($this->user, $plainPassword);
    }
}