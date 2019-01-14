<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 05/01/2019
 * Time: 23:37
 */

namespace AppBundle\FormHandler;


use AppBundle\Entity\User;
use AppBundle\Repository\UserRepository;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class CreateUserHandler
 * @package AppBundle\FormHandler
 */
class CreateUserHandler
{

    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * @var SessionInterface
     */
    private $messageFlash;

    /**
     * CreateUserHandler constructor.
     * @param UserRepository $repository
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param SessionInterface $messageFlash
     */
    public function __construct(
        UserRepository $repository,
        UserPasswordEncoderInterface $passwordEncoder,
        SessionInterface $messageFlash
    ) {
        $this->repository = $repository;
        $this->passwordEncoder = $passwordEncoder;
        $this->messageFlash = $messageFlash;
    }

    /**
     * @param FormInterface $form
     * @param User $user
     * @return bool
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function handle(FormInterface $form, User $user)
    {
        if ($form->isSubmitted() && $form->isValid()) {

            $password = $this->passwordEncoder->encodePassword($user, $user->getPassword());

            $user->setPassword($password);

            $this->repository->save($user);

            $this->messageFlash->getFlashBag()->add('success', "L'utilisateur a bien été ajouté.");

            return true;
        }
        return false;
    }
}