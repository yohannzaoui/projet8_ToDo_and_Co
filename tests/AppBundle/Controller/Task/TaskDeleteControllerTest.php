<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 30/12/2018
 * Time: 13:07
 */

namespace Tests\AppBundle\Controller\Task;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskDeleteControllerTest extends WebTestCase
{
    public function testDeleteTask()
    {
        $client = static::createClient();

        $client->request('GET', '/tasks/delete/{id}');

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }
}