<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 12/01/2019
 * Time: 16:23
 */

namespace Tests\AppBundle\Command;


use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

/**
 * Class CreateAdminCommandTest
 * @package Tests\AppBundle\Command
 */
class CreateAdminCommandTest extends KernelTestCase
{
    /**
     *
     */
    public function testExecute()
    {

        $string = str_shuffle('azertyuiop123456');

        $kernel = static::createKernel();
        $application = new Application($kernel);
        $command = $application->find('app:create-admin');
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'command'  => $command->getName(),
            'username' => $string,
            'password' => 'password',
            'email' => $string.'@email.com',
        ]);

        $output = $commandTester->getDisplay();
        $this->assertContains('You are about to create an admin-user.', $output);
    }


}