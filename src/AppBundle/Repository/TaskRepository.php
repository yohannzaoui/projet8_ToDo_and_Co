<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 09/01/2019
 * Time: 14:40
 */

namespace AppBundle\Repository;

use AppBundle\Entity\Task;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * Class TaskRepository
 * @package AppBundle\Repository
 */
class TaskRepository extends ServiceEntityRepository
{
    /**
     * TaskRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Task::class);
    }

    /**
     * @param $task
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save($task)
    {
        $this->_em->persist($task);
        $this->_em->flush();
    }

    /**
     * @param $task
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete($task)
    {
        $this->_em->remove($task);
        $this->_em->flush();
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function update()
    {
        $this->_em->flush();
    }

}