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
 * Time: 16:03
 */

declare(strict_types=1);

namespace AppBundle\Fixtures;

use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class UserFixtures
 *
 * @package AppBundle\Fixtures
 */
class UserFixtures extends Fixture
{
    /**
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     *
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 20; $i++) {
            $task = new User();
            $task->setUsername('admin ');
            $task->setRoles(['ROLE_ADMIN']);

            $manager->persist($task);
        }

        $manager->flush();
    }
}