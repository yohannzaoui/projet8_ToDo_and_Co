<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 30/12/2018
 * Time: 14:00
 */

namespace Tests\AppBundle\Form;


use AppBundle\Entity\Roles;
use AppBundle\Entity\User;
use AppBundle\Form\UserEditType;
use Symfony\Component\Form\Test\TypeTestCase;

class UserEditTypeTest extends TypeTestCase
{
    public function testForm()
    {
        $roles = $this->createMock(Roles::class);

        $formData = [
            'username' => 'test',
            'email' => 'test@test.com',
            'roles' => $roles
        ];

        $userToCompare = $this->createMock(User::class);

        $form = $this->factory->create(UserEditType::class, $userToCompare);

        $user = $this->createMock(User::class);
        $user->setUsername('test');
        $user->setEmail('test@test.com');
        $user->setRoles($roles);

        $form->submit($formData);

        $this->assertTrue($form->isValid());

        $this->assertEquals($user, $userToCompare);

        $this->assertInstanceOf(User::class, $form->getData());
    }
}