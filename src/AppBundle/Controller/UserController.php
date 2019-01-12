<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 04/01/2019
 * Time: 14:50
 */

namespace AppBundle\Controller;


use AppBundle\Form\UserEditPasswordType;
use AppBundle\FormHandler\CreateUserHandler;
use AppBundle\FormHandler\EditPasswordHandler;
use AppBundle\FormHandler\EditUserHandler;
use AppBundle\Repository\UserRepository;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use AppBundle\Form\UserEditType;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Twig\Environment;

/**
 * Class UserController
 * @package AppBundle\Controller
 */
class UserController
{

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
     * @var UserRepository
     */
    private $repository;

    /**
     * UserController constructor.
     * @param Environment $twig
     * @param FormFactoryInterface $formFactory
     * @param UrlGeneratorInterface $urlGenerator
     * @param UserRepository $repository
     */
    public function __construct(
        Environment $twig,
        FormFactoryInterface $formFactory,
        UrlGeneratorInterface $urlGenerator,
        UserRepository $repository
    ) {
       $this->twig = $twig;
       $this->formFactory = $formFactory;
       $this->urlGenerator = $urlGenerator;
       $this->repository = $repository;
    }

    /**
     * @Route(path="/users/create", name="user_create", methods={"GET","POST"})
     * @param Request $request
     * @param CreateUserHandler $createUserHandler
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function createUser(Request $request, CreateUserHandler $createUserHandler)
    {
        $user = new User();

        $form = $this->formFactory->create(UserType::class, $user)
            ->handleRequest($request);

        if ($createUserHandler->handle($form, $user)) {

            return new RedirectResponse($this->urlGenerator->generate('user_list'),
                RedirectResponse::HTTP_FOUND);
        }

        return new Response($this->twig->render('user/create.html.twig', [
            'form' => $form->createView()
        ]), Response::HTTP_OK);
    }


    /**
     * @Route(path="/delete/user/{id}", name="user_delete", methods={"GET"}, requirements={"id"="\d+"})
     * @param User $user
     * @param TokenStorageInterface $tokenStorage
     * @param SessionInterface $messageFlash
     * @return RedirectResponse
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function deleteUser(User $user, TokenStorageInterface $tokenStorage, SessionInterface $messageFlash)
    {
        if ($user != $tokenStorage->getToken()->getUser()) {

            $this->repository->delete($user);

            $messageFlash->getFlashBag()->add('success', "L'utilisateur a bien été supprimée.");
        }

        return new RedirectResponse($this->urlGenerator->generate('user_list'),
            RedirectResponse::HTTP_FOUND);
    }


    /**
     * @Route(path="/users/{id}/edit", name="user_edit", methods={"GET","POST"}, requirements={"id"="\d+"})
     * @param User $user
     * @param Request $request
     * @param EditUserHandler $editUserHandler
     * @return RedirectResponse|Response
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function editUser(User $user, Request $request, EditUserHandler $editUserHandler)
    {
        $form = $this->formFactory->create(UserEditType::class, $user)
            ->handleRequest($request);

        if ($editUserHandler->handle($form)) {

            return new RedirectResponse($this->urlGenerator->generate('user_list'),
                RedirectResponse::HTTP_FOUND);
        }

        return new Response($this->twig->render('user/edit.html.twig', [
            'form' => $form->createView(),
            'user' => $user
        ]), Response::HTTP_OK);
    }

    /**
     * @Route(path="/users", name="user_list", methods={"GET"})
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function listUsers()
    {
        $users = $this->repository->findAll();

        return new Response($this->twig->render('user/list.html.twig', [
            'users' => $users
        ]), Response::HTTP_OK);
    }

    /**
     * @Route(path="/user/password/{id}", name="user_password", methods={"GET", "POST"}, requirements={"id"="\d+"})
     * @param User $user
     * @param Request $request
     * @param EditPasswordHandler $editPasswordHandler
     * @return RedirectResponse|Response
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function userEditPassword(User $user, Request $request, EditPasswordHandler $editPasswordHandler)
    {
        $form = $this->formFactory->create(UserEditPasswordType::class, $user)
            ->handleRequest($request);

        if ($editPasswordHandler->handle($form, $user)) {

            return new RedirectResponse($this->urlGenerator->generate('user_list'),
                RedirectResponse::HTTP_FOUND);
        }

        return new Response($this->twig->render('user/password.html.twig', [
            'form' => $form->createView(),
            'user' => $user
        ]), Response::HTTP_OK);
    }
}