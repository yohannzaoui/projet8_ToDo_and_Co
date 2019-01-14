<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 09/01/2019
 * Time: 13:31
 */

namespace AppBundle\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;
use AppBundle\Entity\User;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class UserRepository
 * @package AppBundle\Repository
 */
class UserRepository extends ServiceEntityRepository implements UserLoaderInterface
{
    /**
     * UserRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * @param string $username
     * @return UserInterface|void|null
     */
    public function loadUserByUsername($username)
    {

    }


    /**
     * @param $user
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save($user)
    {
        $this->_em->persist($user);
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

    /**
     * @param $user
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete($user)
    {
        $this->_em->remove($user);
        $this->_em->flush();
    }


}