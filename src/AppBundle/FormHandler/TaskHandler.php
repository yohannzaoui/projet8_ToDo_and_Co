<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 05/01/2019
 * Time: 14:13
 */

namespace AppBundle\FormHandler;


use AppBundle\Entity\Task;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class TaskHandler
 * @package AppBundle\FormHandler
 */
class TaskHandler
{
    /**
     * @var ObjectManager
     */
    private $manager;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var SessionInterface
     */
    private $messageFlash;

    /**
     * TaskHandler constructor.
     * @param ObjectManager $manager
     * @param TokenStorageInterface $tokenStorage
     * @param SessionInterface $messageFlash
     */
    public function __construct(
        ObjectManager $manager,
        TokenStorageInterface $tokenStorage,
        SessionInterface $messageFlash
    ) {
        $this->manager = $manager;
        $this->tokenStorage = $tokenStorage;
        $this->messageFlash = $messageFlash;
    }

    /**
     * @param FormInterface $form
     * @param Task $task
     * @return bool
     */
    public function createTaskHandler(FormInterface $form, Task $task)
    {
        if ($form->isSubmitted() && $form->isValid()) {

            $task->setUser($this->tokenStorage->getToken()->getUser());

            $this->manager->getRepository('AppBundle:Task');
            $this->manager->persist($task);
            $this->manager->flush();

            $this->messageFlash->getFlashBag()->add('success', 'La tâche a été bien été ajoutée.');

            return true;
        }
        return false;
    }

    /**
     * @param FormInterface $form
     * @return bool
     */
    public function editTaskHandler(FormInterface $form)
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