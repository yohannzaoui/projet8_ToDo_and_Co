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
use AppBundle\Repository\TaskRepository;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\TaskType;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Twig\Environment;

/**
 * Class TaskController
 * @package AppBundle\Controller
 */
class TaskController
{

    /**
     * @var TaskRepository
     */
    private $repository;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * @var SessionInterface
     */
    private $messageFlash;

    /**
     * TaskController constructor.
     * @param TaskRepository $repository
     * @param TokenStorageInterface $tokenStorage
     * @param Environment $twig
     * @param FormFactoryInterface $formFactory
     * @param UrlGeneratorInterface $urlGenerator
     * @param SessionInterface $messageFlash
     */
    public function __construct(
        TaskRepository $repository,
        TokenStorageInterface $tokenStorage,
        Environment $twig,
        FormFactoryInterface $formFactory,
        UrlGeneratorInterface $urlGenerator,
        SessionInterface $messageFlash

    ) {
        $this->repository = $repository;
        $this->tokenStorage = $tokenStorage;
        $this->twig = $twig;
        $this->formFactory = $formFactory;
        $this->urlGenerator = $urlGenerator;
        $this->messageFlash = $messageFlash;
    }

    /**
     * @Route(path="/tasks", name="task_list", methods={"GET"})
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function tasksList()
    {
        $tasks = $this->repository->findBy([
                'user' => $this->tokenStorage->getToken()->getUser()
            ]);

        return new Response($this->twig->render('task/list.html.twig', [
            'tasks' => $tasks
        ]), Response::HTTP_OK);
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

        $form = $this->formFactory->create(TaskType::class, $task)
            ->handleRequest($request);

        if ($createTaskHandler->handle($form, $task)) {

            return new RedirectResponse($this->urlGenerator->generate('task_list'),
                RedirectResponse::HTTP_FOUND);
        }

        return new Response($this->twig->render('task/create.html.twig', [
            'form' => $form->createView()
        ]), Response::HTTP_OK);
    }


    /**
     * @Route(path="/tasks/edit/{id}", name="task_edit", methods={"GET","POST"}, requirements={"id"="\d+"})
     * @param Task $task
     * @param Request $request
     * @param EditTaskHandler $editTaskHandler
     * @return RedirectResponse|Response
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function editTask(Task $task, Request $request, EditTaskHandler $editTaskHandler)
    {
        $form = $this->formFactory->create(TaskType::class, $task)
            ->handleRequest($request);

        if ($editTaskHandler->handle($form)) {

            return new RedirectResponse($this->urlGenerator->generate('task_list'),
                RedirectResponse::HTTP_FOUND);
        }

        return new Response($this->twig->render('task/edit.html.twig', [
            'form' => $form->createView(),
            'task' => $task,
        ]), Response::HTTP_OK);
    }


    /**
     * @Route(path="/tasks/delete/{id}", name="task_delete", methods={"GET"}, requirements={"id"="\d+"})
     * @param Task $task
     * @return RedirectResponse
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function deleteTask(Task $task)
    {
        $this->repository->delete($task);

        $this->messageFlash->getFlashBag()->add('success', "Tâche supprimée.");

        return new RedirectResponse($this->urlGenerator->generate('task_list'),
            RedirectResponse::HTTP_FOUND);
    }


    /**
     * @Route(path="/tasks-Is-Done", name="tasks_is_done", methods={"GET"})
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function taskIsDone()
    {
        $tasks = $this->repository->findBy([
            'user' => $this->tokenStorage->getToken()->getUser(),
            'isDone' => true
        ]);

        return new Response($this->twig->render('task/is_done.html.twig', [
            'tasks' => $tasks
        ]), Response::HTTP_OK);
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

        $this->repository->update();

        if ($task->isDone() == false) {

            $this->messageFlash->getFlashBag()->add('success', sprintf('La tâche %s a bien été marquée : à faire.', $task->getTitle()));
        }

        return new RedirectResponse($this->urlGenerator->generate('task_list'),
            RedirectResponse::HTTP_FOUND);
    }

}