<?php

namespace Tests\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

class ReportControllerTest extends BaseTestCase
{
    public static function setUpBeforeClass()
    {
        self::tearDownMysql();
        self::setUpMysql();
        self::setUpMysqlFixtures();
    }

    public function testIndex()
    {
        $client = $this->login();

        $client->request('GET', '/report');

        static::assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }

    public function testSettings()
    {
        $client = $this->login();

        $client->request('GET', '/settings');

        static::assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }

    public function testCalendar()
    {
        $client = $this->login();

        $client->request('GET', '/calendar');

        static::assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }

    public function testTasks()
    {
        $client = $this->login();

        $client->request('GET', '/task');

        static::assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }

}