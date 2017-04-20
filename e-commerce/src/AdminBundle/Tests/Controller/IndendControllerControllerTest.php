<?php

namespace AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class IndendControllerControllerTest extends WebTestCase
{
    public function testSeeoders()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/SeeOders');
    }

    public function testDeleteoders()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/DeleteOders');
    }

}
