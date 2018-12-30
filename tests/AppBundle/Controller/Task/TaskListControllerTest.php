<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 30/12/2018
 * Time: 13:10
 */

namespace Tests\AppBundle\Controller\Task;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskListControllerTest extends WebTestCase
{
    public function testTasksList()
    {
        $client = static::createClient();

        $client->request('GET', '/tasks');

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }
}