<?php

namespace UserBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PannierControllerTest extends WebTestCase
{
    public function testAddelement()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/addElement');
    }

    public function testDeleteelement()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/deleteElement');
    }

    public function testValidate()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/validate');
    }

    public function testDisplay()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/display');
    }

}
