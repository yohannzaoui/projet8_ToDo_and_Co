<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 05/01/2019
 * Time: 12:55
 */

namespace Tests\AppBundle\Entity;


use AppBundle\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private $user;

    public function setUp()
    {
        $this->user = new User();
    }

    public function testGetUsernameIfIsString()
    {
        $this->user->setUsername('name');
        $result = $this->user->getUsername();
        $this->assertSame('name', $result);
    }

    public function testGetPasswordIfIsString()
    {
        $this->user->setPassword('name');
        $result = $this->user->getPassword();
        $this->assertSame('name', $result);
    }

    public function testGetEmailIfIsString()
    {
        $this->user->setEmail('name');
        $result = $this->user->getEmail();
        $this->assertSame('name', $result);
    }

    public function testGetRolesIfIsArray()
    {
        $this->user->setRoles(['ROLE_USER']);
        $result = $this->user->getRoles();
        $this->assertSame(['ROLE_USER'], $result);
    }
}