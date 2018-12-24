<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 24/12/2018
 * Time: 12:12
 */

namespace AppBundle\Controller\Task;

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
    public function listAction()
    {
        $user = $this->getUser();

        $tasks = $this->getDoctrine()->getRepository('AppBundle:Task')->findBy(['user' => $user]);

        return $this->render('task/list.html.twig', [
            'tasks' => $tasks
        ]);
    }
}