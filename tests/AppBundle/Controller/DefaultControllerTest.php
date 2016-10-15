<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Tests\AppBundle\Controller\BaseTestCase;

require_once 'BaseTestCase.php';

class DefaultControllerTest extends BaseTestCase
{
//    public function setUp()
//    {
//        parent::setUp(); // TODO: Change the autogenerated stub
//        // load fixtures
//        $this->setUpMysql();
//        $this->setUpMysqlFixtures();
//    }

    public static function setUpBeforeClass()
    {
        self::tearDownMysql();
        self::setUpMysql();
        self::setUpMysqlFixtures();
    }

    public static function tearDownAfterClass()
    {
//        self::tearDownMysql();
    }

    public function testIndex()
    {
        //        $client = static::createClient();

//        $crawler = $client->request('GET', '/login');

//        $this->assertEquals(200, $client->getResponse()->getStatusCode());
//        $this->assertContains('Welcome to Symfony', $crawler->filter('#container h1')->text());
    }

    public function testExportJson()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/login');
        $form = $crawler->selectButton('Login')->form();
        $form['_username'] = 'admin';
        $form['_password'] = 'admin';
        $crawler = $client->submit($form);

//        $crawler = $client->request('GET', '/export_json');

//        static::assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }

    public function testExportPdf()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/login');
        $form = $crawler->selectButton('Login')->form();
        $form['_username'] = 'admin';
        $form['_password'] = 'admin';
        $crawler = $client->submit($form);

        $crawler = $client->request('GET', '/export_pdf');

        static::assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }

    public function testExportXml()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/login');
        $form = $crawler->selectButton('Login')->form();
        $form['_username'] = 'admin';
        $form['_password'] = 'admin';
        $crawler = $client->submit($form);

        $crawler = $client->request('GET', '/export_xml');

        static::assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }

    public function testExportCsv()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/login');
        $form = $crawler->selectButton('Login')->form();
        $form['_username'] = 'admin';
        $form['_password'] = 'admin';
        $crawler = $client->submit($form);

        $crawler = $client->request('GET', '/export_csv');

        static::assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }

    public function testExportXls()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/login');
        $form = $crawler->selectButton('Login')->form();
        $form['_username'] = 'admin';
        $form['_password'] = 'admin';
        $client->submit($form);

        $client->request('GET', '/export_xls');

        static::assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }

    public function testLeadCaptureForm()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/login');
        $form = $crawler->selectButton('Login')->form();
        $form['_username'] = 'admin';
        $form['_password'] = 'admin';
        $client->submit($form);

        $client->request('POST', '/lead/lead_capture_form', [
            'redirectUrl' => 'http://foxweb24.ru/php_coaching/',
            'userId' => 1,
            'name' => 'Andrey',
            'email' => 'andreybolonin1989@gmail.com',
            'phone2' => '380507336953',
            'event' => 'test_event'
        ]);

        static::assertTrue($client->getResponse()->isRedirect('http://foxweb24.ru/php_coaching/'));
        static::assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());
    }
}
