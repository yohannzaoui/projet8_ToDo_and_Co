<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 25/01/2019
 * Time: 14:55
 */

declare(strict_types=1);

namespace AppBundle\Security;

use AppBundle\Entity\Task;
use AppBundle\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

/**
 * @codeCoverageIgnore
 * Class TaskVoter
 * @package AppBundle\Security
 */
class TaskVoter extends Voter
{
    /**
     *
     */
    const EDIT = 'edit';

    /**
     *
     */
    const DELETE = 'delete';

    /**
     * @param string $attribute
     * @param mixed $subject
     * @return bool
     */
    protected function supports($attribute, $subject): bool
    {
        if (!in_array($attribute, [self::EDIT, self::DELETE])) {
            return false;
        }


        if (!$subject instanceof Task) {
            return false;
        }

        return true;
    }

    /**
     * @param string $attribute
     * @param mixed $subject
     * @param TokenInterface $token
     * @return bool
     */
    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            return false;
        }

        $task = $subject;

        switch ($attribute) {
            case self::EDIT:
                return $this->canAccess($task, $user);
            case self::DELETE:
                return $this->canDelete($task, $user);
        }

        throw new \LogicException('This code should not be reached!');
    }


    /**
     * @param Task $task
     * @param User $user
     * @return bool
     */
    private function canAccess(Task $task, User $user): bool
    {
        return $user === $task->getUser();
    }

    /**
     * @param Task $task
     * @param User $user
     * @return bool
     */
    private function canDelete(Task $task, User $user)
    {
        if ($task->getUser() === null & $user->getRoles() === ['ROLE_ADMIN'] or $user === $task->getUser()) {
            return true;
        }
    }

}