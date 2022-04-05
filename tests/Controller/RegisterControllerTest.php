<?php

namespace App\tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegisterControllerTest extends WebTestCase
{
  public function testRegister()
  {
    $client = static::createClient();

    $client->request('GET', '/register');

    $this->assertResponseStatusCodeSame(200);
  }

  // test registration with good credentials
  public function testRegisterWithGoodCredentials()
  {
    $client = static::createClient();
    $crawler = $client->request('GET', '/register');
    $form = $crawler->selectButton('register')->form([
      'registration_form[username]' => 'toto',
      'registration_form[email]' => 'toto',
      'registration_form[plainPassword][first]' => 'toto',
      'registration_form[plainPassword][second]' => 'toto',
    ]);
    $client->submit($form);
    $this->assertResponseStatusCodeSame(200);
  }
}
