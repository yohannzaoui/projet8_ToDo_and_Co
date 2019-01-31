<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 31/01/2019
 * Time: 09:49
 */

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