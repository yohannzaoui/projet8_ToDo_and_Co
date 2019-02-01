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

use AppBundle\Repository\TaskRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

/**
 * Class TaskDoneController
 *
 * @package AppBundle\Controller
 */
class TaskDoneController
{
    /**
     * @Route(path="/tasks-Is-Done", name="tasks_is_done", methods={"GET"})
     * @param                        TaskRepository $repository
     * @param                        Environment    $twig
     * @return                       Response
     * @throws                       \Twig_Error_Loader
     * @throws                       \Twig_Error_Runtime
     * @throws                       \Twig_Error_Syntax
     */
    public function taskIsDone(TaskRepository $repository, Environment $twig)
    {
        $tasks = $repository->findBy(
            [
            'isDone' => true
            ]
        );

        return new Response(
            $twig->render(
                'task/is_done.html.twig', [
                'tasks' => $tasks
                ]
            ), Response::HTTP_OK
        );
    }
}
