<?php
// api/tests/ApiTest.php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiTest extends WebTestCase
{
    /**
     * @var KernelBrowser
     */
    protected $client;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->client = self::createClient();
    }

    /**
     * Retrieves the projects list.
     */
    public function testRetrieveTheProjectsList(): void
    {
        $this->client->request('GET', '/api/projects');
        $response = $this->client->getResponse();
        $json = json_decode($response->getContent(), true);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('application/ld+json; charset=utf-8', $response->headers->get('Content-Type'));

        $this->assertArrayHasKey('hydra:totalItems', $json);
        $this->assertEquals(0, $json['hydra:totalItems']);

        $this->assertArrayHasKey('hydra:member', $json);
        $this->assertCount(0, $json['hydra:member']);
    }
}