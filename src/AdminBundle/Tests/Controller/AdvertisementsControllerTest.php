<?php

namespace AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdvertisementsControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'viewAdvertisementsAction');
    }

    public function testAddadvertisements()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/addAdvertisements');
    }

    public function testUpdateadvertisements()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/updateAdvertisements');
    }

}
