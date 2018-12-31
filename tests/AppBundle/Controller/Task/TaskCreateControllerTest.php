<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 30/12/2018
 * Time: 19:12
 */

namespace Tests\AppBundle\Controller\Task;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskCreateControllerTest extends WebTestCase
{
    public function testPageIsFound()
    {
        $client = static::createClient();

        $client->request('GET', '/tasks/create');

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }

    public function testRedirection()
    {
        $client = static::createClient();

        $client->request('POST', '/tasks/create');

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }
}