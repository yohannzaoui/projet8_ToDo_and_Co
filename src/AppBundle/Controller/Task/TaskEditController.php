<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 24/12/2018
 * Time: 12:16
 */

namespace AppBundle\Controller\Task;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Task;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\TaskType;

/**
 * Class TaskEditController
 * @package AppBundle\Controller
 */
class TaskEditController extends AbstractController
{
    /**
     * @Route(path="/tasks/{id}/edit", name="task_edit", methods={"GET"})
     * @param Task $task
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Task $task, Request $request)
    {
        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'La tâche a bien été modifiée.');

            return $this->redirectToRoute('task_list');
        }

        return $this->render('task/edit.html.twig', [
            'form' => $form->createView(),
            'task' => $task,
        ]);
    }
}