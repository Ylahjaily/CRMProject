<?php


namespace App\Tests\Controller;

use App\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ContactControllerTest extends WebTestCase
{

    public function testIndexPageResponse()
    {
        $client = static::createClient();
        $client->request('GET','/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }


    public function testIndexPageContentTitle()
    {
        $client = static::createClient();
        $client->request('GET','/');

        $this->assertSelectorTextContains('h1','Contact list');
    }

    public function testCreateContactPageResponse()
    {
        $client = static::createClient();
        $client->request('GET','/contact/new');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testCreateContactPageContentTitle()
    {
        $client = static::createClient();
        $client->request('GET','/contact/new');

        $this->assertSelectorTextContains('h1','Add Contact');
    }

    public function testCreateContactSuccess()
    {
        $client = static::createClient();
        $client->followRedirects(true);
        $client->request('GET', '/contact/new');


        $this->assertResponseIsSuccessful();

        $client->submitForm('Submit', [
            'contact[firstname]' => 'Franck',
            'contact[lastname]' => 'Lampard',
            'contact[email]' => 'email@email.com',
            'contact[phoneNumber]' => '0750933920'
        ]);

        $this->assertSelectorTextContains('h1', 'Contact list');
    }

    public function testUpdateContactSuccess()
    {
        $client = static::createClient();
        $client->followRedirects(true);
        $client->request('GET', '/contact/new');


        $this->assertResponseIsSuccessful();

        $client->submitForm('Submit', [
            'contact[firstname]' => 'Franck',
            'contact[lastname]' => 'Lampard'
        ]);

        $this->assertSelectorTextContains('h1', 'Contact list');
    }
}
