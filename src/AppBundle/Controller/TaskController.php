<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 04/01/2019
 * Time: 14:46
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Task;
use AppBundle\FormHandler\CreateTaskHandler;
use AppBundle\FormHandler\EditTaskHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\TaskType;

/**
 * Class TaskController
 * @package AppBundle\Controller
 */
class TaskController extends AbstractController
{

    /**
     * @Route(path="/tasks", name="task_list", methods={"GET"})
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function tasksList()
    {
        $tasks = $this->getDoctrine()->getRepository(Task::class)
            ->findBy([
                'user' => $this->getUser()
            ]);

        return $this->render('task/list.html.twig', [
            'tasks' => $tasks
        ]);
    }


    /**
     * @Route(path="/tasks/create", name="task_create", methods={"GET","POST"})
     * @param Request $request
     * @param CreateTaskHandler $createTaskHandler
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function createTask(Request $request, CreateTaskHandler $createTaskHandler)
    {
        $task = new Task();

        $form = $this->createForm(TaskType::class, $task)
            ->handleRequest($request);

        if ($createTaskHandler->handle($form, $task)) {

            return $this->redirectToRoute('task_list');
        }

        return $this->render('task/create.html.twig', [
            'form' => $form->createView()
        ]);

    }


    /**
     * @Route(path="/tasks/edit/{id}", name="task_edit", methods={"GET","POST"}, requirements={"id"="\d+"})
     * @param Task $task
     * @param Request $request
     * @param EditTaskHandler $editTaskHandler
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editTask(Task $task, Request $request, EditTaskHandler $editTaskHandler)
    {
        $form = $this->createForm(TaskType::class, $task)
            ->handleRequest($request);

        if ($editTaskHandler->handle($form)) {

            return $this->redirectToRoute('task_list');
        }

        return $this->render('task/edit.html.twig', [
            'form' => $form->createView(),
            'task' => $task,
        ]);
    }


    /**
     * @Route(path="/tasks/delete/{id}", name="task_delete", methods={"GET"}, requirements={"id"="\d+"})
     * @param Task $task
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteTask(Task $task)
    {
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($task);
        $manager->flush();

        $this->addFlash('success', "Tâche supprimée.");

        return $this->redirectToRoute('task_list');
    }


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


    /**
     * @Route(path="/tasks/{id}/toggle", name="task_toggle", methods={"GET"}, requirements={"id"="\d+"})
     * @param Task $task
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Exception
     */
    public function toggleTask(Task $task)
    {
        $task->toggle(!$task->isDone());

        $task->setDateIsDone(new \DateTime());

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