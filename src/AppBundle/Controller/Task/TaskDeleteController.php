<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 24/12/2018
 * Time: 12:20
 */

namespace AppBundle\Controller\Task;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Task;

/**
 * Class TaskDeleteController
 * @package AppBundle\Controller
 */
class TaskDeleteController extends AbstractController
{
    /**
     * @Route(path="/tasks/delete/{id}", name="task_delete", methods={"GET"}, requirements={"id"="\d+"})
     * @param Task $task
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteTask(Task $task)
    {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($task);
            $entityManager->flush();

            $this->addFlash('success', "Tâche supprimée.");

            return $this->redirectToRoute('task_list');
    }
}