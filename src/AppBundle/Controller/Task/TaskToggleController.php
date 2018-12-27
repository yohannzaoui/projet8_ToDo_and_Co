<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 24/12/2018
 * Time: 12:18
 */

namespace AppBundle\Controller\Task;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Task;

/**
 * Class TaskToggleController
 * @package AppBundle\Controller
 */
class TaskToggleController extends AbstractController
{
    /**
     * @Route(path="/tasks/{id}/toggle", name="task_toggle", methods={"GET"})
     * @param Task $task
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function toggleTaskAction(Task $task)
    {
        $task->toggle(!$task->isDone());

        $this->getDoctrine()->getManager()->flush();

        if ($task->isDone() == false) {

            $this->addFlash('success', sprintf('La tâche %s a bien été marquée : à faire.', $task->getTitle()));
        }

        if ($task->isDone() == true) {

            $this->addFlash('success', sprintf('La tâche %s a bien été marquée comme terminée.', $task->getTitle()));
        }

        return $this->redirectToRoute('task_list');
    }
}