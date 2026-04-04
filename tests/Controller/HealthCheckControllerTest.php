<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class HealthCheckControllerTest extends WebTestCase
{
    public function testHealthCheck(): void
    {
        $client = static::createClient();
        $client->request('GET', '/');

        self::assertResponseIsSuccessful();
        self::assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        self::assertEquals('ok', $client->getResponse()->getContent());
    }

    public function testHealthCheckPost(): void
    {
        $client = static::createClient();
        $client->request('POST', '/');

        self::assertResponseStatusCodeSame(Response::HTTP_METHOD_NOT_ALLOWED);
    }

    public function testHealthCheckHead(): void
    {
        $client = static::createClient();
        $client->request('HEAD', '/');

        self::assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function testHealthCheckPut(): void
    {
        $client = static::createClient();
        $client->request('PUT', '/');

        self::assertResponseStatusCodeSame(Response::HTTP_METHOD_NOT_ALLOWED);
    }
}
