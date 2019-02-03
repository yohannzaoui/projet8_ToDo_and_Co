<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 01/02/2019
 * Time: 16:05
 */

namespace Tests\AppBundle\Controller;


use Tests\AppBundle\AppWebTestCase;

/**
 * Class TaskListControllerTest
 * @package Tests\AppBundle\Controller
 */
class TaskListControllerTest extends AppWebTestCase
{
    /**
     *
     */
    public function testTaskListRedirectionIfNoLogin()
    {
        $this->client->request('GET', '/tasks');

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
    }


    /**
     *
     */
    public function testTasksListResponse()
    {
        $this->loginUser();

        $crawler = $this->client->request('GET', '/tasks');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertSame(
            1,
            $crawler->filter('html:contains("Créer une tâche")')->count());
    }

    /**
     *
     */
    public function testGetTaskListPageFromHome()
    {
        $this->logIn();

        $crawler = $this->client->request('GET', '/');

        $link = $crawler->selectLink('Consulter les tâches à faire')->link();

        $crawler = $this->client->click($link);

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertSame(
            1,
            $crawler->filter('html:contains("Liste des tâches terminées")')->count());
    }
}