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

use AppBundle\Repository\UserRepository;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Class EditUserHandler
 *
 * @package AppBundle\FormHandler
 */
class EditUserHandler
{
    /**
     * @var UserRepository
     */
    private $_repository;

    /**
     * @var SessionInterface
     */
    private $_messageFlash;


    /**
     * EditUserHandler constructor.
     *
     * @param UserRepository   $repository
     * @param SessionInterface $messageFlash
     */
    public function __construct(
        UserRepository $repository,
        SessionInterface $messageFlash
    ) {
        $this->_repository = $repository;
        $this->_messageFlash = $messageFlash;
    }

    /**
     * @param  FormInterface $form
     * @return bool
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function handle(FormInterface $form)
    {
        if ($form->isSubmitted() && $form->isValid()) {

            $this->_repository->update();

            $this->_messageFlash->getFlashBag()->add('success', "L'utilisateur a bien été modifié.");

            return true;
        }
        return false;
    }

}
