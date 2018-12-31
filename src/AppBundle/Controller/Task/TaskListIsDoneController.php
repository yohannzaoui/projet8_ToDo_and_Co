<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 26/12/2018
 * Time: 18:39
 */

namespace AppBundle\Controller\Task;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TaskListIsDoneController
 * @package AppBundle\Controller\Task
 */
class TaskListIsDoneController extends AbstractController
{
    /**
     * @Route(path="/tasks-Is-Done", name="tasks_is_done", methods={"GET"})
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function taskIsDone()
    {
        $tasks = $this->getDoctrine()->getRepository('AppBundle:Task')->findBy([
            'user' => $this->getUser(),
            'isDone' => true
        ]);

        return $this->render('task/is_done.html.twig', [
            'tasks' => $tasks
        ]);
    }

}