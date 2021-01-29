<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\GetMailboxStatsBody;
use Zimbra\Admin\Message\GetMailboxStatsEnvelope;
use Zimbra\Admin\Message\GetMailboxStatsRequest;
use Zimbra\Admin\Message\GetMailboxStatsResponse;

use Zimbra\Admin\Struct\MailboxStats;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetMailboxStats.
 */
class GetMailboxStatsTest extends ZimbraTestCase
{
    public function testGetMailboxStats()
    {
        $numMboxes = mt_rand(1, 100);
        $totalSize = mt_rand(1, 100);

        $request = new GetMailboxStatsRequest();

        $stats = new MailboxStats($numMboxes, $totalSize);
        $response = new GetMailboxStatsResponse($stats);
        $this->assertSame($stats, $response->getStats());
        $response = new GetMailboxStatsResponse(new MailboxStats(0, 0));
        $response->setStats($stats);
        $this->assertSame($stats, $response->getStats());

        $body = new GetMailboxStatsBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new GetMailboxStatsBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetMailboxStatsEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new GetMailboxStatsEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetMailboxStatsRequest />
        <urn:GetMailboxStatsResponse>
            <stats numMboxes="$numMboxes" totalSize="$totalSize" />
        </urn:GetMailboxStatsResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetMailboxStatsEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'GetMailboxStatsRequest' => [
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'GetMailboxStatsResponse' => [
                    'stats' => [
                        'numMboxes' => $numMboxes,
                        'totalSize' => $totalSize,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, GetMailboxStatsEnvelope::class, 'json'));
    }
}
