<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 30/12/2018
 * Time: 13:13
 */

namespace Tests\AppBundle\Controller\Task;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskListIsDoneControllerTest extends WebTestCase
{
    public function testTaskIsDone()
    {
        $client = static::createClient();

        $client->request('GET', '/tasks-Is-Done');

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }
}