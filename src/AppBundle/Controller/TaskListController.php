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

use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Repository\TaskRepository;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

/**
 * Class TaskListController
 *
 * @package AppBundle\Controller
 */
class TaskListController
{
    /**
     * @Route(path="/tasks", name="task_list", methods={"GET"})
     * @param                TaskRepository $repository
     * @param                Environment    $twig
     * @return               Response
     * @throws               \Twig_Error_Loader
     * @throws               \Twig_Error_Runtime
     * @throws               \Twig_Error_Syntax
     */
    public function tasksList(TaskRepository $repository, Environment $twig)
    {
        $tasks = $repository->taskList();

        return new Response(
            $twig->render(
                'task/list.html.twig', [
                'tasks' => $tasks
                ]
            ), Response::HTTP_OK
        );
    }
}
