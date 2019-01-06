<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 05/01/2019
 * Time: 23:50
 */

namespace AppBundle\FormHandler;


use AppBundle\Entity\User;
use AppBundle\Service\PasswordEncoderService;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Class EditPasswordHandler
 * @package AppBundle\FormHandler
 */
class EditPasswordHandler
{
    /**
     * @var ObjectManager
     */
    private $manager;

    /**
     * @var PasswordEncoderService
     */
    private $passwordEncoder;

    /**
     * @var SessionInterface
     */
    private $messageFlash;

    /**
     * EditPasswordHandler constructor.
     * @param ObjectManager $manager
     * @param PasswordEncoderService $passwordEncoder
     * @param SessionInterface $messageFlash
     */
    public function __construct(
        ObjectManager $manager,
        PasswordEncoderService $passwordEncoder,
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
    public function handle(FormInterface $form, User $user)
    {
        if ($form->isSubmitted() && $form->isValid()) {

            $password = $this->passwordEncoder
                ->encoder($user->getPassword());

            $user->setPassword($password);

            $this->manager->getRepository('AppBundle:User');
            $this->manager->flush();

            $this->messageFlash->getFlashBag()->add('success', "Le mot de passe à bien été modifié.");

            return true;
        }
        return false;
    }
}