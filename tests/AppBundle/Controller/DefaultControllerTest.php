<?php

namespace Tests\AppBundle\Controller;


use Tests\AppBundle\AppWebTestCase;

/**
 * Class DefaultControllerTest
 * @package Tests\AppBundle\Controller
 */
class DefaultControllerTest extends AppWebTestCase
{

    /**
     *
     */
    public function testRedirectionIfNoLogin()
    {
        $this->client->request('GET', '/');

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
    }


    /**
     *
     */
    public function testHomeIfLogin()
    {
        $this->logInUser();

        $crawler = $this->client->request('GET', '/');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertSame(1, $crawler->filter('html:contains("Bienvenue sur Todo List, l\'application vous permettant de gérer l\'ensemble de vos tâches sans effort !")')->count());
    }
}
