<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 30/12/2018
 * Time: 19:08
 */

namespace Tests\AppBundle\Controller\User;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserCreateControllerTest extends WebTestCase
{
    public function testPageIsFound()
    {
        $client = static::createClient();

        $client->request('GET', '/users/create');

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }

    public function testRedirection()
    {
        $client = static::createClient();

        $client->request('POST', '/users/create');

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }
}