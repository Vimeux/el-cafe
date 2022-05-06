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
    $form = $crawler->selectButton('S\'enregistrer')->form([
      'registration_form[email]' => 'toto@gmail.com',
      'registration_form[plainPassword]' => 'test1234',
      'registration_form[agreeTerms]' => false,
    ]);
    $client->submit($form);
    $this->assertResponseStatusCodeSame(500);
  }
}
