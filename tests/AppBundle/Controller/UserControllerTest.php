<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 04/01/2019
 * Time: 23:20
 */

namespace Tests\AppBundle\Controller;


use Tests\AppBundle\AppWebTestCase;

class UserControllerTest extends AppWebTestCase
{

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

    public function testAddUserForm()
    {
        $this->logIn();

        $crawler = $this->client->request('POST', '/users/create');

        $form = $crawler->selectButton('Ajouter')->form();

        $string = str_shuffle('azertyuiopqsdfghjklm12345');

        $form['user[username]'] = 'test';
        $form['user[password][first]'] = 'password';
        $form['user[password][second]'] = 'password';
        $form['user[email]'] = $string.'@email.com';
        $form['user[roles]'] = 'ROLE_USER';

        $this->client->submit($form);

        $crawler = $this->client->followRedirect();

        $this->assertSame(1, $crawler->filter('html:contains("L\'utilisateur a bien été ajouté.")')->count());
    }

    public function testEditPasswordForm()
    {
        $this->logIn();


        $crawler = $this->client->request('POST', '/user/password/3');

        $form = $crawler->selectButton('Modifer')->form();

        $form['user_edit_password[password][first]'] = 'password';
        $form['user_edit_password[password][second]'] = 'password';

        $this->client->submit($form);

        $crawler = $this->client->followRedirect();

        $this->assertSame(1, $crawler->filter('html:contains("Liste des utilisateurs")')->count());
    }

    public function testDeleteUserIfNoLogin()
    {
        $this->client->request('GET', '/delete/user/3');

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
    }

    public function testDeleteUser()
    {
        $this->logIn();

        $this->client->request('GET', '/delete/user/3');

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
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

}