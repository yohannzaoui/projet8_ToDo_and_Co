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

namespace AppBundle\Controller;

use AppBundle\Entity\Task;
use AppBundle\Repository\TaskRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Class TaskToggleController
 *
 * @package AppBundle\Controller
 */
class TaskToggleController
{
    /**
     * @Route(path="/tasks/{id}/toggle", name="task_toggle", methods={"GET"})
     * @param                            Task                  $task
     * @param                            TaskRepository        $repository
     * @param                            UrlGeneratorInterface $urlGenerator
     * @param                            SessionInterface      $messageFlash
     * @return                           RedirectResponse
     * @throws                           \Doctrine\ORM\ORMException
     * @throws                           \Doctrine\ORM\OptimisticLockException
     */
    public function toggleTask(
        Task $task,
        TaskRepository $repository,
        UrlGeneratorInterface $urlGenerator,
        SessionInterface $messageFlash
    ) {
        $task->toggle(!$task->isDone());

        $repository->update();

        if ($task->isDone() == false) {

            $messageFlash->getFlashBag()->add('success', sprintf('La tâche %s a bien été marquée : à faire.', $task->getTitle()));
        }

        return new RedirectResponse(
            $urlGenerator->generate('task_list'),
            RedirectResponse::HTTP_FOUND
        );
    }
}
