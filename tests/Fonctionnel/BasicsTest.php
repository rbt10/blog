<?php

namespace App\Tests\Fonctionnel;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

class BasicsTest extends WebTestCase
{
    public function testEnvironnementOk() : void{

        $client = static::createClient();
        $client->request(Request::METHOD_GET, '/');
        $this->assertResponseIsSuccessful();
    }
}