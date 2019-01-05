<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 05/01/2019
 * Time: 15:33
 */

namespace AppBundle\FormHandler;

use AppBundle\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Form\FormInterface;

/**
 * Class UserHandler
 * @package AppBundle\FormHandler
 */
class UserHandler
{

    /**
     * @var ObjectManager
     */
    private $manager;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * @var SessionInterface
     */
    private $messageFlash;

    /**
     * UserHandler constructor.
     * @param ObjectManager $manager
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param SessionInterface $messageFlash
     */
    public function __construct(
        ObjectManager $manager,
        UserPasswordEncoderInterface $passwordEncoder,
        SessionInterface $messageFlash
    ) {
        $this->manager = $manager;
        $this->passwordEncoder = $passwordEncoder;
        $this->messageFlash = $messageFlash;
    }

    /**
     * @param FormInterface $form
     * @param User $user
     * @return bool
     */
    public function createUserHandler(FormInterface $form, User $user)
    {
        if ($form->isSubmitted() && $form->isValid()) {

            $password = $this->passwordEncoder
                ->encodePassword($user, $user->getPassword());

            $user->setPassword($password);

            $this->manager->getRepository('AppBundle:User');
            $this->manager->persist($user);
            $this->manager->flush();

            $this->messageFlash->getFlashBag()->add('success', "L'utilisateur a bien été ajouté.");

            return true;
        }
        return false;
    }

    /**
     * @param FormInterface $form
     * @return bool
     */
    public function editUserHandler(FormInterface $form)
    {
        if ($form->isSubmitted() && $form->isValid()) {

            $this->manager->getRepository('AppBundle:User');
            $this->manager->flush();

            $this->messageFlash->getFlashBag()->add('success', "L'utilisateur a bien été modifié.");

            return true;
        }
        return false;
    }

    /**
     * @param FormInterface $form
     * @param User $user
     * @return bool
     */
    public function editPasswordHandler(FormInterface $form, User $user)
    {
        if ($form->isSubmitted() && $form->isValid()) {

            $password = $this->passwordEncoder
                ->encodePassword($user, $user->getPassword());

            $user->setPassword($password);

            $this->manager->getRepository('AppBundle:User');
            $this->manager->flush();

            $this->messageFlash->getFlashBag()->add('success', "Le mot de passe à bien été modifié.");

            return true;
        }
        return false;
    }
}