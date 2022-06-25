<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Request;

use Zimbra\Admin\Message\GetIndexStatsBody;
use Zimbra\Admin\Message\GetIndexStatsEnvelope;
use Zimbra\Admin\Message\GetIndexStatsRequest;
use Zimbra\Admin\Message\GetIndexStatsResponse;

use Zimbra\Admin\Struct\MailboxByAccountIdSelector;
use Zimbra\Admin\Struct\IndexStats;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetIndexStats.
 */
class GetIndexStatsTest extends ZimbraTestCase
{
    public function testGetIndexStats()
    {
        $id = $this->faker->uuid;
        $maxDocs = mt_rand(1, 100);
        $numDeletedDocs = mt_rand(1, 100);

        $mbox = new MailboxByAccountIdSelector($id);
        $stats = new IndexStats($maxDocs, $numDeletedDocs);

        $request = new GetIndexStatsRequest($mbox);
        $this->assertSame($mbox, $request->getMbox());
        $request = new GetIndexStatsRequest(new MailboxByAccountIdSelector($id));
        $request->setMbox($mbox);
        $this->assertSame($mbox, $request->getMbox());

        $response = new GetIndexStatsResponse($stats);
        $this->assertSame($stats, $response->getStats());
        $response = new GetIndexStatsResponse(new IndexStats($maxDocs, $numDeletedDocs));
        $response->setStats($stats);
        $this->assertSame($stats, $response->getStats());

        $body = new GetIndexStatsBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new GetIndexStatsBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetIndexStatsEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new GetIndexStatsEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetIndexStatsRequest>
            <mbox id="$id" />
        </urn:GetIndexStatsRequest>
        <urn:GetIndexStatsResponse>
            <stats maxDocs="$maxDocs" deletedDocs="$numDeletedDocs" />
        </urn:GetIndexStatsResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetIndexStatsEnvelope::class, 'xml'));
    }
}
