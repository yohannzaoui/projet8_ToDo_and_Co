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

namespace AppBundle\FormHandler;

use AppBundle\Repository\TaskRepository;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Class EditTaskHandler
 *
 * @package AppBundle\FormHandler
 */
class EditTaskHandler
{
    /**
     * @var TaskRepository
     */
    private $repository;

    /**
     * @var SessionInterface
     */
    private $messageFlash;

    /**
     * EditTaskHandler constructor.
     *
     * @param TaskRepository   $repository
     * @param SessionInterface $messageFlash
     */
    public function __construct(
        TaskRepository $repository,
        SessionInterface $messageFlash
    ) {
        $this->repository = $repository;
        $this->messageFlash = $messageFlash;
    }

    /**
     * @param  FormInterface $form
     * @return bool
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function handle(FormInterface $form)
    {
        if ($form->isSubmitted() && $form->isValid()) {

            $this->repository->update();

            $this->messageFlash->getFlashBag()->add('success', 'La tâche a bien été modifiée.');

            return true;
        }
        return false;
    }

}
