<?php declare(strict_types=1);

namespace Zimbra\Tests\Soap;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for Soap client.
 */
class ClientTest extends ZimbraTestCase
{
    public function testSoapClient()
    {
        $contents = $this->faker->text;
        $client = $this->mockSoapClient($contents);
        $response = $client->sendRequest($contents);
        $this->assertSame($contents, $response->getBody()->getContents());
    }
}
