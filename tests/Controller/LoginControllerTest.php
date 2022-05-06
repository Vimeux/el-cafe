<?php

namespace App\tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Response;

class LoginControllerTest extends WebTestCase
{
    public function testLogin()
    {
        $client = static::createClient();

        $client->request('GET', '/login');

        $this->assertResponseStatusCodeSame(200);
    }

    public function testLoginWithBadCredentials()
    {
      $client = static::createClient();
      $crawler = $client->request('GET', '/login');
      $form = $crawler->selectButton('Se connecter')->form([
        '_username' => 'toto',
        '_password' => 'toto',
      ]);
      $client->submit($form);
      $this->assertResponseStatusCodeSame(500);
    }
}

