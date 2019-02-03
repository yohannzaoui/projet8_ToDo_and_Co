<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 04/01/2019
 * Time: 23:20
 */

namespace Tests\AppBundle\Controller;

use Tests\AppBundle\AppWebTestCase;

/**
 * Class TaskControllerTest
 * @package Tests\AppBundle\Controller
 */
class TaskControllerTest extends AppWebTestCase
{

    /**
     *
     */
    public function testCreateTaskRedirectionIfNoLogin()
    {
        $this->client->request('GET', '/tasks/create');

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
    }


    /**
     *
     */
    public function testCreateTaskPageIsFound()
    {
        $this->logInUser();

        $crawler = $this->client->request('GET', '/tasks/create');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertSame(
            1,
            $crawler->filter('html:contains("Créer une tâche")')->count());
    }


    /**
     *
     */
    public function testCreateTaskRedirectionIfLogin()
    {
        $this->logInUser();

        $this->client->request('POST', '/tasks/create');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }


    /**
     *
     */
    public function testCreateTaskForm()
    {
        $this->logIn();

        $crawler = $this->client->request('GET', '/');

        $link = $crawler->selectLink('Créer une nouvelle tâche')->link();

        $crawler = $this->client->click($link);

        $form = $crawler->selectButton('Ajouter')->form();
        $form['task[title]'] = 'functional test title';
        $form['task[content]'] = 'functional test content';

        $this->client->submit($form);

        $crawler = $this->client->followRedirect();

        $this->assertSame(1, $crawler->filter('div.alert.alert-dismissible.alert-success')->count());
    }


    /**
     *
     */
    public function testEditTaskForm()
    {
        $this->logIn();

        $crawler = $this->client->request('GET', '/tasks/edit/79');

        $form = $crawler->selectButton('Modifier')->form();
        $form['task[title]'] = 'functional test title';
        $form['task[content]'] = 'functional test content';

        $this->client->submit($form);
        $crawler = $this->client->followRedirect();
        $this->assertSame(1, $crawler->filter('div.alert.alert-dismissible.alert-success')->count());
    }


    /**
     *
     */
    public function testDeleteTaskResponseIfLogin()
    {
        $this->login();

        $this->client->request('GET', '/tasks/delete/79');

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
    }


    /**
     *
     */
    public function testTaskEditRedirectionIfNoLogin()
    {
        $this->client->request('GET', '/tasks/edit/77');

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
    }


    /**
     *
     */
    public function testTaskEditPageIsFound()
    {
        $this->logIn();

        $crawler = $this->client->request('GET', '/tasks/edit/79');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertSame(1, $crawler->filter('html:contains("Modifier la tâche")')->count());
    }


    /**
     *
     */
    public function testEditTaskRedirection()
    {
        $this->logInUser();

        $this->client->request('POST', '/tasks/edit/77');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    /**
     *
     */
    public function testEditTaskIfError()
    {
        if (!$this->logInUser()) {

            $this->client->request('POST', '/tasks/edit/77');

            $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        }

    }

}