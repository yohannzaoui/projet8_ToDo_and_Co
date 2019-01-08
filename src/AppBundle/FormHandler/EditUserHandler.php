<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 05/01/2019
 * Time: 23:44
 */

namespace AppBundle\FormHandler;

use AppBundle\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Class EditUserHandler
 * @package AppBundle\FormHandler
 */
class EditUserHandler
{
    /**
     * @var ObjectManager
     */
    private $manager;

    /**
     * @var SessionInterface
     */
    private $messageFlash;


    /**
     * EditUserHandler constructor.
     * @param ObjectManager $manager
     * @param SessionInterface $messageFlash
     */
    public function __construct(
        ObjectManager $manager,
        SessionInterface $messageFlash
    ) {
        $this->manager = $manager;
        $this->messageFlash = $messageFlash;
    }

    /**
     * @param FormInterface $form
     * @return bool
     */
    public function handle(FormInterface $form)
    {
        if ($form->isSubmitted() && $form->isValid()) {

            $this->manager->getRepository('AppBundle:User');

            $this->manager->flush();

            $this->messageFlash->getFlashBag()->add('success', "L'utilisateur a bien été modifié.");

            return true;
        }
        return false;
    }
}