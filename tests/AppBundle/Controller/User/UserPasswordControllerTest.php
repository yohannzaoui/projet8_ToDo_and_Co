<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 30/12/2018
 * Time: 19:04
 */

namespace Tests\AppBundle\Controller\User;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserPasswordControllerTest extends WebTestCase
{
    public function testPageIsFound()
    {
        $client = static::createClient();

        $client->request('GET', '/user/password/{id}');

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }

    public function testRedirection()
    {
        $client = static::createClient();

        $client->request('POST', '/user/password/{id}');

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }
}