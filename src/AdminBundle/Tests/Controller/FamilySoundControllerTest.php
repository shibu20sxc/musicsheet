<?php

namespace AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FamilySoundControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/index');
    }

    public function testAddsound()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/addSound');
    }

    public function testUpdatesound()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/updateSound');
    }

}
