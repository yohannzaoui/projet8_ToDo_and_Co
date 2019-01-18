<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 30/12/2018
 * Time: 18:56
 */

namespace Tests\AppBundle\Form;


use AppBundle\Entity\User;
use AppBundle\Form\UserEditPasswordType;
use Symfony\Component\Form\Test\TypeTestCase;

/**
 * Class UserPasswordTypeTest
 * @package Tests\AppBundle\Form
 */
class UserPasswordTypeTest extends TypeTestCase
{


    /**
     *
     */
    public function testForm()
    {
        $formData = [
            'password' => 'pass'
        ];

        $userToCompare = $this->createMock(User::class);

        $form = $this->factory->create(UserEditPasswordType::class, $userToCompare);

        $user = $this->createMock(User::class);
        $user->setPassword('pass');

        $form->submit($formData);

        $this->assertEquals($user, $userToCompare);

        $this->assertInstanceOf(User::class, $form->getData());
    }
}