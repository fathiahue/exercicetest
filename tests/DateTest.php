<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DateTest extends WebTestCase
{
    public function testOK(): string
    {
        $client = static::createClient();
        $client->request('GET', '/datesDifferentes/01-02-2021/05-02-2021');
        $response = $client->getResponse();
        $content = $response->getContent();
        
        $this->assertEquals('{
            "date1": "02-02-2021",
            "date2": "03-02-2021",
            "date3": "04-02-2021"
        }', $content);     
    }

    public function testString(): string
    {
        $client = static::createClient();
        $client->request('GET', '/datesDifferentes/azerty/05-02-2021');
        $response = $client->getResponse();
        $statusCode = $response->getStatusCode();
                
        $this->assertNotEquals(200, $statusCode);
            
    }

    public function test1parameter(): string
    {
        $client = static::createClient();
        $response = $client->request('GET', '/datesDifferentes/05-02-2021');
                
        if ($this->assertResponseIsSuccessful()) {
            return  "test manqué: il manque 1 paramètre";
        } else {
            return  "test réussi";
        }  
    }

    public function testOrder(): string
    {
        $client = static::createClient();
        $response = $client->request('GET', '/datesDifferentes/05-02-2021/01-02-2021');
                
        if ($this->assertResponseIsSuccessful()) {
            return  "test manqué: commencer par saisir la date la plus ancienne";
        } else {
            return "test réussi";
        }  
    }

    public function testFormat(): string
    {
        $client = static::createClient();
        $response = $client->request('GET', '/datesDifferentes/2021-02-05/01-02-2021');
                
        if ($this->assertResponseIsSuccessful()) {
            return  "test manqué: commencer par saisir la date la plus ancienne";
        } else {
            return  "test réussi";
        }  
    }
}
