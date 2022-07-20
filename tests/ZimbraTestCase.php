<?php declare(strict_types=1);

namespace Zimbra\Tests;

use Faker\Factory as FakerFactory;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\{ResponseInterface, StreamInterface};
use Zimbra\Common\SerializerFactory;
use Zimbra\Soap\ClientInterface;

/**
 * Base testcase class for all Zimbra testcases.
 */
abstract class ZimbraTestCase extends TestCase
{
    protected $faker;
    protected $serializer;

    protected function setUp(): void
    {
        $this->faker = FakerFactory::create();
        $this->serializer = SerializerFactory::create();
    }

    protected function mockSoapClient(string $contents): ClientInterface
    {
        $stream = $this->createStub(StreamInterface::class);
        $stream->method('getContents')->willReturn($contents);
        $response = $this->createStub(ResponseInterface::class);
        $response->method('getBody')->willReturn($stream);
        $client = $this->createStub(ClientInterface::class);
        $client->method('sendRequest')->willReturn($response);
        return $client;
    }
}
