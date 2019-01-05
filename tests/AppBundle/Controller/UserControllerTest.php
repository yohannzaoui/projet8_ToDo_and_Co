<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 04/01/2019
 * Time: 23:20
 */

namespace Tests\AppBundle\Controller;

use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{

    private $client;

    public function setUp()
    {
        $this->client = static::createClient();
    }

    public function testUserCreatePageIsFound()
    {
        $this->logIn();

        $crawler = $this->client->request('GET', '/users/create');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertSame(
            1,
            $crawler->filter('html:contains("Créer un utilisateur")')->count());
    }

    public function testUserCreateRedirection()
    {
        $this->logIn();

        $this->client->request('POST', '/users/create');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    /*public function testForm()
    {
        $this->logIn();

        $crawler = $this->client->request('POST', '/users/create');

        $form = $crawler->selectButton('ajouter')->form();

        $form['user[username]'] = 'test';
        $form['user[password][first]'] = 'password';
        $form['user[password][second]'] = 'password';
        $form['user[email]'] = 'email@email.com';
        $form['user[roles]'] = 'ROLE_USER';

        $crawler = $this->client->submit();

        $this->client->followRedirect();

        $this->assertSame(1, $crawler->filter('alert alert-dismissible alert-success')->count());

    }*/

    public function testDeleteUserIfNoLogin()
    {
        $this->client->request('GET', '/delete/user/16');

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
    }

    public function testDeleteUser()
    {
        $this->logIn();

        $this->client->request('GET', '/delete/user/{id}');

        $this->assertEquals(404, $this->client->getResponse()->getStatusCode());
    }

    public function testUserEditRedirectionIfNoLogin()
    {
        $this->client->request('GET', '/users/3/edit');

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
    }

    public function testUserEditPageIsFound()
    {
        $this->logIn();

        $crawler = $this->client->request('GET', '/users/3/edit');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertSame(
            1,
            $crawler->filter('html:contains("Modifier")')->count());
    }

    public function testUserEditRedirection()
    {
        $this->logIn();

        $this->client->request('POST', '/users/3/edit');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    public function testListUsers()
    {
        $this->logIn();

        $crawler = $this->client->request('GET', '/users');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertSame(
            1,
            $crawler->filter('html:contains("Liste des utilisateurs")')->count());
    }

    public function testUserListRedirectionIfNoLogin()
    {

        $this->client->request('GET', '/users');

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
    }

    public function testUserPasswordRedirectionIfNoLogin()
    {

        $this->client->request('GET', '/user/password/3');

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
    }

    public function testUserPasswordPageIsFound()
    {
        $this->logIn();

        $crawler = $this->client->request('GET', '/user/password/3');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertSame(
            1,
            $crawler->filter('html:contains("Modifier le mot de passe de")')->count());
    }

    public function testUserPasswordRedirection()
    {
        $this->logIn();

        $this->client->request('POST', '/user/password/3');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    private function logIn()
    {
        $session = $this->client->getContainer()->get('session');

        $firewallName = 'main';

        $firewallContext = 'main';

        $token = new UsernamePasswordToken('admin', null, $firewallName, array('ROLE_ADMIN'));
        $session->set('_security_'.$firewallContext, serialize($token));
        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());
        $this->client->getCookieJar()->set($cookie);
    }
}