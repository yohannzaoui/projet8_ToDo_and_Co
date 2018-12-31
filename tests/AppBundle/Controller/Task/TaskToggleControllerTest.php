<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 30/12/2018
 * Time: 13:17
 */

namespace Tests\AppBundle\Controller\Task;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskToggleControllerTest extends WebTestCase
{
    public function testToggleTask()
    {
        $client = static::createClient();

        $client->request('GET', '/tasks/{id}/toggle');

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }
}