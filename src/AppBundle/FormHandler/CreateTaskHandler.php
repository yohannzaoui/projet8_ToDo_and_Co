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

use AppBundle\Repository\TaskRepository;
use Symfony\Component\Form\FormInterface;
use AppBundle\Entity\Task;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class CreateTaskHandler
 *
 * @package AppBundle\FormHandler
 */
class CreateTaskHandler
{
    /**
     * @var TaskRepository
     */
    private $_repository;

    /**
     * @var TokenStorageInterface
     */
    private $_tokenStorage;

    /**
     * @var SessionInterface
     */
    private $_messageFlash;


    public function __construct(
        TaskRepository $repository,
        TokenStorageInterface $tokenStorage,
        SessionInterface $messageFlash
    ) {
        $this->_repository = $repository;
        $this->_tokenStorage = $tokenStorage;
        $this->_messageFlash = $messageFlash;
    }

    /**
     * @param  FormInterface $form
     * @param  Task          $task
     * @return bool
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function handle(FormInterface $form, Task $task)
    {
        if ($form->isSubmitted() && $form->isValid()) {

            $task->setUser($this->_tokenStorage->getToken()->getUser());

            $this->_repository->save($task);

            $this->_messageFlash->getFlashBag()->add('success', 'La tâche a bien été ajoutée.');

            return true;
        }
        return false;
    }

}
