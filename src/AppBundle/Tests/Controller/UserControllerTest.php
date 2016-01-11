<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function testCreatearticle()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'create-article');
    }

    public function testEditarticle()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/edit-article');
    }

}
