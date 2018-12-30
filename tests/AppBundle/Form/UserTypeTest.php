<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 30/12/2018
 * Time: 14:42
 */

namespace Tests\AppBundle\Form;


use AppBundle\Entity\Roles;
use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Symfony\Component\Form\Test\TypeTestCase;

class UserTypeTest extends TypeTestCase
{
    public function testForm()
    {
        $roles = $this->createMock(Roles::class);

        $formData = [
          'username' => 'test',
            'password' => [
                'first_option' => 'pass',
                'second_option' => 'pass'
            ],
            'email' => 'test@test.com',
            'roles' => $roles
        ];

        $userToCompare = $this->createMock(User::class);

        $form = $this->factory->create(UserType::class, $userToCompare);

        $user = $this->createMock(User::class);
        $user->setUsername('test');
        $user->setPassword('pass');
        $user->setEmail('test@test.com');
        $user->setRoles($roles);

        $form->submit($formData);

        $this->assertTrue($form->isValid());

        $this->assertEquals($user, $userToCompare);

        $this->assertInstanceOf(User::class, $form->getData());

    }
}