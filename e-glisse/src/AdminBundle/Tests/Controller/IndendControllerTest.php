<?php

namespace AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class IndendControllerTest extends WebTestCase
{
    public function testSeeoders()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/seeOders');
    }

    public function testDeleteodres()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/deleteOdres');
    }

}
