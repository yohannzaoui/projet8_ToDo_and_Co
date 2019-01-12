<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 30/12/2018
 * Time: 13:36
 */

namespace Tests\AppBundle\Controller\Security;


use Tests\AppBundle\AppWebTestCase;

/**
 * Class SecurityControllerTest
 * @package Tests\AppBundle\Controller\Security
 */
class SecurityControllerTest extends AppWebTestCase
{
    /**
     *
     */
    public function testLogin()
    {

        $crawler = $this->client->request('GET', '/login');

        static::assertEquals(200, $this->client->getResponse()->getStatusCode());

        static::assertSame(1, $crawler->filter('html:contains("Nom d\'utilisateur :")')->count());
        static::assertSame(1, $crawler->filter('html:contains("Mot de passe :")')->count());
    }


    /**
     *
     */
    public function testLoginCheck()
    {
        $this->client->request('POST', '/login_check');

        static::assertEquals(302, $this->client->getResponse()->getStatusCode());
    }


    /**
     *
     */
    public function testLogoutCheck()
    {
        $this->client->request('GET', '/login');

        static::assertEquals(200, $this->client->getResponse()->getStatusCode());
    }
}