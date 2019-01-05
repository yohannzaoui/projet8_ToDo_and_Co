<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 05/01/2019
 * Time: 23:21
 */

namespace AppBundle\FormHandler;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Class EditTaskHandler
 * @package AppBundle\FormHandler
 */
class EditTaskHandler
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
     * CreateTaskHandler constructor.
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

            $this->manager->getRepository('AppBundle:Task');
            $this->manager->flush();

            $this->messageFlash->getFlashBag()->add('success', 'La tâche a bien été modifiée.');

            return true;
        }
        return false;
    }
}