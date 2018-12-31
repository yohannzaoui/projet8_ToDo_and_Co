<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 30/12/2018
 * Time: 13:25
 */

namespace Tests\AppBundle\Controller\User;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserDeleteControllerTest extends WebTestCase
{
    public function testDeleteUser()
    {
        $client = static::createClient();

        $client->request('GET', '/delete/user/{id}');

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }
}