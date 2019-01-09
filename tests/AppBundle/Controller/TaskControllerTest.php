<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 04/01/2019
 * Time: 23:20
 */

namespace Tests\AppBundle\Controller;


use AppBundle\Entity\Task;
use Tests\AppBundle\AppWebTestCase;

class TaskControllerTest extends AppWebTestCase
{

    public function testTaskListRedirectionIfNoLogin()
    {
        $this->client->request('GET', '/tasks');

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
    }

    public function testTasksListResponse()
    {
        $this->login();

        $crawler = $this->client->request('GET', '/tasks');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertSame(
            1,
            $crawler->filter('html:contains("Créer une tâche")')->count());
    }


    public function testCreateTaskRedirectionIfNoLogin()
    {
        $this->client->request('GET', '/tasks/create');

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
    }

    public function testCreateTaskPageIsFound()
    {
        $this->logIn();

        $crawler = $this->client->request('GET', '/tasks/create');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertSame(
            1,
            $crawler->filter('html:contains("Créer une tâche")')->count());
    }

    public function testCreateTaskRedirectionIfLogin()
    {
        $this->logIn();

        $this->client->request('POST', '/tasks/create');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    public function testCreateTaskForm()
    {
        $this->logIn();

        $task = $this->createMock(Task::class);

        $crawler = $this->client->request('GET', '/');

        $link = $crawler->selectLink('Créer une nouvelle tâche')->link();

        $crawler = $this->client->click($link);

        $form = $crawler->selectButton('Ajouter')->form();
        $form['task[title]'] = 'functional test title';
        $form['task[content]'] = 'functional test content';

        $task->setUser($this->user());

        $this->client->submit($form);
        $crawler = $this->client->followRedirect();
        $this->assertSame(1, $crawler->filter('div.alert.alert-dismissible.alert-success')->count());
    }

    public function testDeleteTaskResponseIfLogin()
    {
        $this->login();

        $this->client->request('GET', '/tasks/delete/50');

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
    }


    public function testTaskEditRedirectionIfNoLogin()
    {
        $this->client->request('GET', '/tasks/edit/3');

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
    }

    public function testTaskEditPageIsFound()
    {
        $this->logIn();

        $crawler = $this->client->request('GET', '/tasks/edit/3');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertSame(
            1,
            $crawler->filter('html:contains("Modifier la tâche")')->count());
    }

    public function testEditTaskRedirection()
    {
        $this->logIn();

        $this->client->request('POST', '/tasks/edit/2');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    public function testTaskListIsDoneRedirectionIfNoLogin()
    {
        $this->client->request('GET', '/tasks-Is-Done');

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
    }

    public function testTaskIsDoneResponse()
    {
        $this->logIn();

        $crawler = $this->client->request('GET', '/tasks-Is-Done');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertSame(
            1,
            $crawler->filter('html:contains("Retour à la liste des tâches")')->count());
    }

    public function testTaskToggleRedirectionIfNoLogin()
    {
        $this->client->request('GET', '/tasks/3/toggle');

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
    }

    public function testToggleTask()
    {
        $this->logIn();

        $this->client->request('GET', '/tasks/3/toggle');

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
    }
}