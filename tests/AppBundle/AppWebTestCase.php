<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 09/01/2019
 * Time: 11:13
 */

namespace Tests\AppBundle;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

/**
 * Class AppWebTestCase
 * @package Tests\AppBundle
 */
class AppWebTestCase extends WebTestCase
{

    /**
     * @var
     */
    protected $client;

    /**
     *
     */
    protected function setUp()
    {
        $this->client = static::createClient();
    }


    /**
     *
     */
    protected function logIn()
    {
        $session = $this->client->getContainer()->get('session');
        //$em = $this->client->getContainer()->get('doctrine.orm.entity_manager');
        //$user = $em->getRepository(User::class)->findOneBy(['username'=>'admin']);

        $token = new UsernamePasswordToken('admin1', null, 'main', ['ROLE_ADMIN']);
        $session->set('_security_'.'main', serialize($token));
        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());
        $this->client->getCookieJar()->set($cookie);
    }



}