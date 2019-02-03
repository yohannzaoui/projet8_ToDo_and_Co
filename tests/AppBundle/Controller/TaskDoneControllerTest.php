<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 01/02/2019
 * Time: 16:17
 */

namespace Tests\AppBundle\Controller;


use Tests\AppBundle\AppWebTestCase;

/**
 * Class TaskDoneControllerTest
 * @package Tests\AppBundle\Controller
 */
class TaskDoneControllerTest extends AppWebTestCase
{
    /**
     *
     */
    public function testTaskListIsDoneRedirectionIfNoLogin()
    {
        $this->client->request('GET', '/tasks-Is-Done');

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
    }


    /**
     *
     */
    public function testGetDoneTaskListPageFromHomePage()
    {
        $this->logInUser();

        $crawler = $this->client->request('GET', '/');

        $link = $crawler->selectLink('Consulter les tâches terminées')->link();

        $crawler = $this->client->click($link);

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertSame(1, $crawler->filter('html:contains("Retour à la liste des tâches")')->count());
    }


    /**
     *
     */
    public function testTaskIsDoneResponse()
    {
        $this->logInUser();

        $crawler = $this->client->request('GET', '/tasks-Is-Done');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertSame(1, $crawler->filter('html:contains("Retour à la liste des tâches")')->count());
    }
}