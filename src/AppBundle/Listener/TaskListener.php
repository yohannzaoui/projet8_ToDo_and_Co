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

use Doctrine\ORM\Event\LifecycleEventArgs;
use AppBundle\Entity\Task;

/**
 * Class TaskListener
 * @package AppBundle\Listener
 */
class TaskListener
{
    /**
     * @var
     */
    private $cacheDriver;

    /**
     * TaskListener constructor.
     * @param $cacheDriver
     */
    public function __construct($cacheDriver)
    {
        $this->cacheDriver = $cacheDriver;
    }

    /**
     * @param Task $task
     * @param LifecycleEventArgs $args
     */
    public function postPersist(Task $task, LifecycleEventArgs $args)
    {
        $this->cacheDriver->expire('[tasks][1]', 0);
    }

    /**
     * @param Task $task
     * @param LifecycleEventArgs $args
     */
    public function postUpdate(Task $task, LifecycleEventArgs $args)
    {
        $this->cacheDriver->expire('[tasks][1]', 0);
    }

    /**
     * @param Task $task
     * @param LifecycleEventArgs $args
     */
    public function postRemove(Task $task, LifecycleEventArgs $args)
    {
        $this->cacheDriver->expire('[tasks][1]', 0);
    }
}