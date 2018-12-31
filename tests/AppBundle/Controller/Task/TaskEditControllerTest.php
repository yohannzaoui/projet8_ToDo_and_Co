<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 30/12/2018
 * Time: 19:14
 */

namespace Tests\AppBundle\Controller\Task;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskEditControllerTest extends WebTestCase
{
    public function testPageIsFound()
    {
        $client = static::createClient();

        $client->request('GET', '/tasks/edit/{id}');

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }

    public function testRedirection()
    {
        $client = static::createClient();

        $client->request('POST', '/tasks/edit/{id}');

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }
}