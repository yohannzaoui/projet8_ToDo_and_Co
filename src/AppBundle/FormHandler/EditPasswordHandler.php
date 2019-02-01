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

namespace AppBundle\FormHandler;

use AppBundle\Entity\User;
use AppBundle\Repository\UserRepository;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class EditPasswordHandler
 *
 * @package AppBundle\FormHandler
 */
class EditPasswordHandler
{

    /**
     * @var UserRepository
     */
    private $_repository;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $_passwordEncoder;

    /**
     * @var SessionInterface
     */
    private $_messageFlash;


    /**
     * EditPasswordHandler constructor.
     *
     * @param UserRepository               $repository
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param SessionInterface             $messageFlash
     */
    public function __construct(
        UserRepository $repository,
        UserPasswordEncoderInterface $passwordEncoder,
        SessionInterface $messageFlash
    ) {
        $this->_repository = $repository;
        $this->_passwordEncoder = $passwordEncoder;
        $this->_messageFlash = $messageFlash;
    }

    /**
     * @param  FormInterface $form
     * @param  User          $user
     * @return bool
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function handle(FormInterface $form, User $user)
    {
        if ($form->isSubmitted() && $form->isValid()) {

            $password = $this->_passwordEncoder->encodePassword($user, $user->getPassword());

            $user->setPassword($password);

            $this->_repository->update();

            $this->_messageFlash->getFlashBag()->add('success', "Le mot de passe à bien été modifié.");

            return true;
        }
        return false;
    }

}
