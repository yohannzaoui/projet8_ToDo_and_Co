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

use AppBundle\Entity\Task;
use AppBundle\FormHandler\CreateTaskHandler;
use AppBundle\FormHandler\EditTaskHandler;
use AppBundle\Repository\TaskRepository;
use AppBundle\Security\TaskVoter;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\TaskType;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Twig\Environment;

/**
 * Class TaskController
 *
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
     * @var AuthorizationCheckerInterface
     */
    private $authorization;

    /**
     * TaskController constructor.
     *
     * @param TaskRepository                $repository
     * @param TokenStorageInterface         $tokenStorage
     * @param Environment                   $twig
     * @param FormFactoryInterface          $formFactory
     * @param UrlGeneratorInterface         $urlGenerator
     * @param SessionInterface              $messageFlash
     * @param AuthorizationCheckerInterface $authorization
     */
    public function __construct(
        TaskRepository $repository,
        TokenStorageInterface $tokenStorage,
        Environment $twig,
        FormFactoryInterface $formFactory,
        UrlGeneratorInterface $urlGenerator,
        SessionInterface $messageFlash,
        AuthorizationCheckerInterface $authorization
    ) {
        $this->repository = $repository;
        $this->tokenStorage = $tokenStorage;
        $this->twig = $twig;
        $this->formFactory = $formFactory;
        $this->urlGenerator = $urlGenerator;
        $this->messageFlash = $messageFlash;
        $this->authorization = $authorization;
    }


    /**
     * @Route(path="/tasks/create", name="task_create", methods={"GET","POST"})
     * @param                       Request           $request
     * @param                       CreateTaskHandler $createTaskHandler
     * @return                      \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws                      \Exception
     */
    public function createTask(
        Request $request,
        CreateTaskHandler $createTaskHandler
    ) {
        $task = new Task();

        $form = $this->formFactory->create(TaskType::class, $task)
            ->handleRequest($request);

        if ($createTaskHandler->handle($form, $task)) {

            return new RedirectResponse(
                $this->urlGenerator->generate('task_list'),
                RedirectResponse::HTTP_FOUND
            );
        }

        return new Response(
            $this->twig->render(
                'task/create.html.twig', [
                'form' => $form->createView()
                ]
            ), Response::HTTP_OK
        );
    }


    /**
     * @Route(path="/tasks/edit/{id}", name="task_edit", methods={"GET","POST"})
     * @param                          Task            $task
     * @param                          Request         $request
     * @param                          EditTaskHandler $editTaskHandler
     * @return                         RedirectResponse|Response
     * @throws                         \Doctrine\ORM\ORMException
     * @throws                         \Doctrine\ORM\OptimisticLockException
     * @throws                         \Twig_Error_Loader
     * @throws                         \Twig_Error_Runtime
     * @throws                         \Twig_Error_Syntax
     */
    public function editTask(
        Task $task,
        Request $request,
        EditTaskHandler $editTaskHandler
    ) {

        if ($this->authorization->isGranted(TaskVoter::EDIT, $task) === true) {

            $form = $this->formFactory->create(TaskType::class, $task)
                ->handleRequest($request);

            if ($editTaskHandler->handle($form)) {

                return new RedirectResponse(
                    $this->urlGenerator->generate('task_list'),
                    RedirectResponse::HTTP_FOUND
                );
            }

            return new Response(
                $this->twig->render(
                    'task/edit.html.twig', [
                    'form' => $form->createView(),
                    'task' => $task,
                    ]
                ), Response::HTTP_OK
            );
        }

        return new Response(
            $this->twig->render(
                'error/error.html.twig', [
                'error' => "Erreur : Impossible d'éditer cette tâche."
                ]
            ), Response::HTTP_OK
        );
    }


    /**
     * @Route(path="/tasks/delete/{id}", name="task_delete", methods={"GET"})
     * @param                            Task $task
     * @return                           RedirectResponse|Response
     * @throws                           \Doctrine\ORM\ORMException
     * @throws                           \Doctrine\ORM\OptimisticLockException
     * @throws                           \Twig_Error_Loader
     * @throws                           \Twig_Error_Runtime
     * @throws                           \Twig_Error_Syntax
     */
    public function deleteTask(Task $task)
    {
        if ($this->authorization->isGranted(TaskVoter::DELETE, $task) === true) {

            $this->repository->delete($task);

            $this->messageFlash->getFlashBag()->add('success', "Tâche supprimée.");

            return new RedirectResponse(
                $this->urlGenerator->generate('task_list'),
                RedirectResponse::HTTP_FOUND
            );
        }
        return new Response(
            $this->twig->render(
                'error/error.html.twig', [
                'error' => 'Erreur : Impossible de supprimer cette tâche.'
                ]
            ), Response::HTTP_OK
        );

    }

}
