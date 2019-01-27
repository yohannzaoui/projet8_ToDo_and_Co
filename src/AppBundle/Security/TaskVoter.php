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
     *
     */
    const DONE = 'done';

    /**
     * @param string $attribute
     * @param mixed $subject
     * @return bool
     */
    protected function supports($attribute, $subject): bool
    {
        if (!in_array($attribute, [self::EDIT, self::DELETE, self::DONE])) {
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
                return $this->canAccess($task, $user);
            case self::DONE:
                return $this->canAccess($task, $user);
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

}