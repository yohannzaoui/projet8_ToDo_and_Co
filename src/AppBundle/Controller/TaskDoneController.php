<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 01/02/2019
 * Time: 16:15
 */

namespace AppBundle\Controller;

use AppBundle\Repository\TaskRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

/**
 * Class TaskDoneController
 * @package AppBundle\Controller
 */
class TaskDoneController
{
    /**
     * @Route(path="/tasks-Is-Done", name="tasks_is_done", methods={"GET"})
     * @param TaskRepository $repository
     * @param Environment $twig
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function taskIsDone(TaskRepository $repository, Environment $twig): Response
    {
        $tasks = $repository->findBy([
            'isDone' => true
        ]);

        return new Response($twig->render('task/is_done.html.twig', [
            'tasks' => $tasks
        ]), Response::HTTP_OK);
    }
}