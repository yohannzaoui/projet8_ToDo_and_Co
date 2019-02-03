<?php
/**
 *
 * @category
 * @package
 * @author   Yohann Zaoui <yohannzaoui@gmail.com>
 * @license
 * @link
 * Created by PhpStorm.
 * Date: 03/02/2019
 * Time: 16:33
 */

declare(strict_types=1);

namespace AppBundle\Fixtures;

use AppBundle\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class UserFixtures
 *
 * @package AppBundle\Fixtures
 */
class UserFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     *
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 5; $i++) {
            $user = new User();
            $user->setUsername('User'. $i);
            $user->setEmail("user$i@mail.com");
            $user->setPassword($this->passwordEncoder->encodePassword($user, 'password'. $i));
            $user->setRoles(['ROLE_USER']);
            $manager->persist($user);
        }
        $user = new User();
        $user->setUsername('root');
        $user->setEmail('root@mail.com');
        $user->setPassword($this->passwordEncoder->encodePassword($user, 'root'));
        $user->setRoles(['ROLE_ADMIN']);
        $manager->persist($user);
        $manager->flush();
    }
    /**
     * @param ContainerInterface|null $container
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->passwordEncoder = $container->get('security.password_encoder');
    }
}