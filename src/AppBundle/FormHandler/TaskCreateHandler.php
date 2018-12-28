<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 28/12/2018
 * Time: 15:49
 */

namespace AppBundle\FormHandler;

use AppBundle\Entity\Task;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class TaskCreateHandler
 * @package AppBundle\FormHandler
 */
class TaskCreateHandler
{
    /**
     * @var ManagerRegistry
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
     * TaskCreateHandler constructor.
     * @param ManagerRegistry $manager
     * @param TokenStorageInterface $tokenStorage
     * @param SessionInterface $messageFlash
     */
    public function __construct(
        ManagerRegistry $manager,
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
    public function handle(FormInterface $form, Task $task)
    {
        if ($form->isSubmitted() && $form->isValid()) {

            $task->setUser($this->tokenStorage->getToken()->getUser());

            $this->manager->getManager()->persist($task);
            $this->manager->getManager()->flush();

            $this->messageFlash->getFlashBag()->add('success', 'La tâche a été bien été ajoutée.');

            return true;
        }
        return false;
    }
}