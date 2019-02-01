<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 01/02/2019
 * Time: 18:33
 */

namespace Tests\AppBundle\Controller;


use Tests\AppBundle\AppWebTestCase;

class TaskToggleControllerTest extends AppWebTestCase
{
    /**
     *
     */
    public function testTaskToggleRedirectionIfNoLogin()
    {
        $this->client->request('GET', '/tasks/77/toggle');

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
    }


    /**
     *
     */
    public function testToggleTask()
    {
        $this->logIn();

        $this->client->request('GET', '/tasks/79/toggle');

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
    }

    /**
     *
     */
    public function testToggleTaskIfError()
    {
        if (!$this->logIn()) {

            $this->client->request('GET', '/tasks/56/toggle');

            $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
        }

    }
}