<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 30/12/2018
 * Time: 19:10
 */

namespace Tests\AppBundle\Controller\User;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserEditControllerTest extends WebTestCase
{
    public function testPageIsFound()
    {
        $client = static::createClient();

        $client->request('GET', '/users/{id}/edit');

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }

    public function testRedirection()
    {
        $client = static::createClient();

        $client->request('POST', '/users/{id}/edit');

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }
}