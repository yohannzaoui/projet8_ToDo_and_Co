<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 30/12/2018
 * Time: 13:36
 */

namespace Tests\AppBundle\Controller\Security;


use Tests\AppBundle\AppWebTestCase;

class SecurityControllerTest extends AppWebTestCase
{
    public function testLogin()
    {

        $this->client->request('GET', '/login');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }
}