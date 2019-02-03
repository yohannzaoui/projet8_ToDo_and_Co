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

namespace AppBundle\Listener;

use AppBundle\Entity\User;
use Doctrine\ORM\Event\LifecycleEventArgs;

/**
 * @codeCoverageIgnore
 *
 * Class UserListener
 *
 * @package AppBundle\Listener
 */
class UserListener
{
    /**
     * @var
     */
    private $cacheDriver;

    /**
     * UserListener constructor.
     *
     * @param $cacheDriver
     */
    public function __construct($cacheDriver)
    {
        $this->cacheDriver = $cacheDriver;
    }

    /**
     * @param \AppBundle\Entity\User                 $user
     * @param \Doctrine\ORM\Event\LifecycleEventArgs $args
     */
    public function postPersist(User $user, LifecycleEventArgs $args)
    {
        $this->cacheDriver->expire('[users][1]', 0);
    }

    /**
     * @param \AppBundle\Entity\User                 $user
     * @param \Doctrine\ORM\Event\LifecycleEventArgs $args
     */
    public function postUpdate(User $user, LifecycleEventArgs $args)
    {
        $this->cacheDriver->expire('[users][1]', 0);
    }

    /**
     * @param \AppBundle\Entity\User                 $user
     * @param \Doctrine\ORM\Event\LifecycleEventArgs $args
     */
    public function postRemove(User $user, LifecycleEventArgs $args)
    {
        $this->cacheDriver->expire('[users][1]', 0);
    }
}