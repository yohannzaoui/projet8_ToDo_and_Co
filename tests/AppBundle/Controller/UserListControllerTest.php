<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 01/02/2019
 * Time: 17:52
 */

namespace Tests\AppBundle\Controller;


use Tests\AppBundle\AppWebTestCase;

class UserListControllerTest extends AppWebTestCase
{
    /**
     *
     */
    public function testListUsers()
    {
        $this->logIn();

        $crawler = $this->client->request('GET', '/users');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertSame(1, $crawler->filter('html:contains("Nom d\'utilisateur")')->count());
    }


    /**
     *
     */
    public function testUserListRedirectionIfNoLogin()
    {
        $this->client->request('GET', '/users');

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
    }
}