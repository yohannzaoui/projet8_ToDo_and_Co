<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 05/01/2019
 * Time: 23:44
 */

declare(strict_types=1);

namespace AppBundle\FormHandler;

use AppBundle\Repository\UserRepository;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Class EditUserHandler
 * @package AppBundle\FormHandler
 */
class EditUserHandler
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * @var SessionInterface
     */
    private $messageFlash;


    /**
     * EditUserHandler constructor.
     * @param UserRepository $repository
     * @param SessionInterface $messageFlash
     */
    public function __construct(
        UserRepository $repository,
        SessionInterface $messageFlash
    ) {
        $this->repository = $repository;
        $this->messageFlash = $messageFlash;
    }

    /**
     * @param FormInterface $form
     * @return bool
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function handle(FormInterface $form): bool
    {
        if ($form->isSubmitted() && $form->isValid()) {

            $this->repository->update();

            $this->messageFlash->getFlashBag()->add('success', "L'utilisateur a bien été modifié.");

            return true;
        }
        return false;
    }

}