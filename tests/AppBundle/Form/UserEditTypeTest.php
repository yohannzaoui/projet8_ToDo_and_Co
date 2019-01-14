<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 30/12/2018
 * Time: 14:00
 */

namespace Tests\AppBundle\Form;


use AppBundle\Entity\User;
use AppBundle\Form\UserEditType;
use Symfony\Component\Form\Test\TypeTestCase;

/**
 * Class UserEditTypeTest
 * @package Tests\AppBundle\Form
 */
class UserEditTypeTest extends TypeTestCase
{

    /**
     *
     */
    public function testForm()
    {

        $formData = [
            'username' => 'test',
            'email' => 'test@test.com',
            'roles' => 'test'
        ];

        $userToCompare = $this->createMock(User::class);

        $form = $this->factory->create(UserEditType::class, $userToCompare);

        $user = $this->createMock(User::class);
        $user->setUsername('test');
        $user->setEmail('test@test.com');
        $user->setRoles('test');

        $form->submit($formData);

        $this->assertTrue($form->isValid());

        $this->assertEquals($user, $userToCompare);

        $this->assertInstanceOf(User::class, $form->getData());
    }
}