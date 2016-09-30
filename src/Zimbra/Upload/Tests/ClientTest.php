<?php

namespace Zimbra\Common\Tests;

use \PHPUnit_Framework_TestCase;
use Faker\Factory as FakerFactory;
use Zimbra\Upload\Client;
use GuzzleHttp\Client as HttpClient;

/**
 * Testcase class for upload client class.
 */
class ClientTest extends PHPUnit_Framework_TestCase
{
    protected $faker;

    protected function setUp()
    {
        $this->faker = FakerFactory::create();
    }

    public function testClient()
    {
        $location = $this->faker->word;
        $authToken = $this->faker->word;
        $httpClient = new HttpClient();
        $foo = $this->faker->word;
        $bar = $this->faker->word;

        $client = new Client($location, $authToken);
        $this->assertSame($location, $client->getLocation());
        $this->assertSame($authToken, $client->getAuthToken());
        $this->assertTrue($client->hasHeader('Method'));
        $this->assertTrue($client->hasHeader('User-Agent'));

        $client = new Client('', '');
        $client->setLocation($location)
            ->setAuthToken($authToken)
            ->setHttpClient($httpClient)
            ->setHeaders(['foo' => $foo])
            ->addHeader('bar', $bar);
        $this->assertSame($location, $client->getLocation());
        $this->assertSame($authToken, $client->getAuthToken());
        $this->assertSame($httpClient, $client->getHttpClient());
        $this->assertSame(['foo' => $foo, 'bar' => $bar], $client->getHeaders());
    }
}
