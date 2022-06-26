<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\{GetMailQueueBody, GetMailQueueEnvelope, GetMailQueueRequest, GetMailQueueResponse};

use Zimbra\Admin\Struct\ServerMailQueueQuery;
use Zimbra\Admin\Struct\QueueQueryField;
use Zimbra\Admin\Struct\QueueQuery;
use Zimbra\Admin\Struct\MailQueueQuery;
use Zimbra\Admin\Struct\ValueAttrib;

use Zimbra\Admin\Struct\ServerMailQueueDetails;
use Zimbra\Admin\Struct\MailQueueDetails;
use Zimbra\Admin\Struct\QueueSummary;
use Zimbra\Admin\Struct\QueueSummaryItem;
use Zimbra\Admin\Struct\QueueItem;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetMailQueue.
 */
class GetMailQueueTest extends ZimbraTestCase
{
    public function testGetMailQueue()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);
        $wait = mt_rand(0, 100);
        $scanTime = time();
        $total = mt_rand(1, 100);
        $id = $this->faker->word;
        $time = $this->faker->word;
        $fromdomain = $this->faker->word;
        $size = $this->faker->word;
        $from = $this->faker->word;
        $to = $this->faker->word;
        $host = $this->faker->word;
        $addr = $this->faker->word;
        $reason = $this->faker->word;
        $filter = $this->faker->word;
        $todomain = $this->faker->word;
        $received = $this->faker->word;
        $count = mt_rand(1, 100);
        $term = $this->faker->word;
        $type = $this->faker->word;

        $query = new QueueQuery(
            [new QueueQueryField($name, [new ValueAttrib($value)])],
            $limit,
            $offset
        );
        $queue = new MailQueueQuery($query, $name, TRUE, $wait);
        $server = new ServerMailQueueQuery($queue, $name);

        $request = new GetMailQueueRequest($server);
        $this->assertSame($server, $request->getServer());
        $request = new GetMailQueueRequest(new ServerMailQueueQuery($queue, ''));
        $request->setServer($server);
        $this->assertSame($server, $request->getServer());

        $qs = new QueueSummary($type, [new QueueSummaryItem($count, $term)]);
        $qi = new QueueItem(
            $id, $time, $fromdomain, $size, $from, $to, $host, $addr, $reason, $filter, $todomain, $received
        );
        $queue = new MailQueueDetails($name, $scanTime, TRUE, $total, TRUE, [$qs], [$qi]);
        $server = new ServerMailQueueDetails($queue, $name);

        $response = new GetMailQueueResponse($server);
        $this->assertSame($server, $response->getServer());

        $response = new GetMailQueueResponse(new ServerMailQueueDetails($queue, ''));
        $response->setServer($server);
        $this->assertSame($server, $response->getServer());

        $body = new GetMailQueueBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new GetMailQueueBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetMailQueueEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new GetMailQueueEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetMailQueueRequest>
            <urn:server name="$name">
                <urn:queue name="$name" scan="true" wait="$wait">
                    <urn:query limit="$limit" offset="$offset">
                        <urn:field name="$name">
                            <urn:match value="$value" />
                        </urn:field>
                    </urn:query>
                </urn:queue>
            </urn:server>
        </urn:GetMailQueueRequest>
        <urn:GetMailQueueResponse>
            <urn:server name="$name">
                <urn:queue name="$name" time="$scanTime" scan="true" total="$total" more="true">
                    <urn:qs type="$type">
                        <urn:qsi n="$count" t="$term" />
                    </urn:qs>
                    <urn:qi id="$id" time="$time" fromdomain="$fromdomain" size="$size" from="$from" to="$to" host="$host" addr="$addr" reason="$reason" filter="$filter" todomain="$todomain" received="$received" />
                </urn:queue>
            </urn:server>
        </urn:GetMailQueueResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetMailQueueEnvelope::class, 'xml'));
    }
}
