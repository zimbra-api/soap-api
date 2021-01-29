<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\GetServerStatsBody;
use Zimbra\Admin\Message\GetServerStatsEnvelope;
use Zimbra\Admin\Message\GetServerStatsRequest;
use Zimbra\Admin\Message\GetServerStatsResponse;

use Zimbra\Admin\Struct\Stat;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetServerStatsTest.
 */
class GetServerStatsTest extends ZimbraTestCase
{
    public function testGetServerStats()
    {
        $value = $this->faker->word;
        $name = $this->faker->word;
        $description = $this->faker->word;

        $stat = new Stat($value, $name, $description);

        $request = new GetServerStatsRequest([$stat]);
        $this->assertSame([$stat], $request->getStats());
        $request = new GetServerStatsRequest();
        $request->setStats([$stat])
            ->addStat($stat);
        $this->assertSame([$stat, $stat], $request->getStats());
        $request->setStats([$stat]);

        $response = new GetServerStatsResponse([$stat]);
        $this->assertSame([$stat], $response->getStats());
        $response = new GetServerStatsResponse();
        $response->setStats([$stat])
            ->addStat($stat);
        $this->assertSame([$stat, $stat], $response->getStats());
        $response->setStats([$stat]);

        $body = new GetServerStatsBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetServerStatsBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetServerStatsEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetServerStatsEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetServerStatsRequest>
            <stat name="$name" description="$description">$value</stat>
        </urn:GetServerStatsRequest>
        <urn:GetServerStatsResponse>
            <stat name="$name" description="$description">$value</stat>
        </urn:GetServerStatsResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetServerStatsEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'GetServerStatsRequest' => [
                    'stat' => [
                        [
                            'name' => $name,
                            'description' => $description,
                            '_content' => $value,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'GetServerStatsResponse' => [
                    'stat' => [
                        [
                            'name' => $name,
                            'description' => $description,
                            '_content' => $value,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, GetServerStatsEnvelope::class, 'json'));
    }
}
