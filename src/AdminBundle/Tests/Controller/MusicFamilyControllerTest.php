<?php

namespace AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MusicFamilyControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/index');
    }

    public function testAddfamily()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/addFamily');
    }

    public function testUpdatefamily()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/updateFamily');
    }

}
