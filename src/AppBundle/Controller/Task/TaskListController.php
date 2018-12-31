<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 24/12/2018
 * Time: 12:12
 */

namespace AppBundle\Controller\Task;

use AppBundle\Entity\Task;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class TaskListController
 * @package AppBundle\Controller
 */
class TaskListController extends AbstractController
{
    /**
     * @Route(path="/tasks", name="task_list", methods={"GET"})
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function tasksList()
    {
        $tasks = $this->getDoctrine()
            ->getRepository(Task::class)
            ->findBy([
                'user' => $this->getUser(),
                'isDone' => false
        ]);

        return $this->render('task/list.html.twig', [
            'tasks' => $tasks
        ]);
    }
}