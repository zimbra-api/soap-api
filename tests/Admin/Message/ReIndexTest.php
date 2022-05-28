<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\ReIndexBody;
use Zimbra\Admin\Message\ReIndexEnvelope;
use Zimbra\Admin\Message\ReIndexRequest;
use Zimbra\Admin\Message\ReIndexResponse;
use Zimbra\Admin\Struct\ReindexMailboxInfo;
use Zimbra\Admin\Struct\ReindexProgressInfo;
use Zimbra\Common\Enum\ReIndexAction;
use Zimbra\Common\Enum\ReIndexStatus;
use Zimbra\Common\Enum\ReindexType;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ReIndex.
 */
class ReIndexTest extends ZimbraTestCase
{
    public function testReIndexEnvelope()
    {
        $id = $this->faker->word;
        $ids = $this->faker->word;
        $enums = $this->faker->randomElements(ReindexType::toArray(), mt_rand(1, count(ReindexType::toArray())));
        $types = implode(',', $enums);
        $numSucceeded = mt_rand(1, 100);
        $numFailed = mt_rand(1, 100);
        $numRemaining = mt_rand(1, 100);

        $mbox = new ReindexMailboxInfo($id, $types, $ids);
        $request = new ReIndexRequest($mbox, ReIndexAction::STATUS());
        $this->assertEquals($mbox, $request->getMbox());
        $this->assertEquals(ReIndexAction::STATUS(), $request->getAction());
        $request = new ReIndexRequest(new ReindexMailboxInfo(''));
        $request->setMbox($mbox)
            ->setAction(ReIndexAction::START());
        $this->assertEquals($mbox, $request->getMbox());
        $this->assertEquals(ReIndexAction::START(), $request->getAction());

        $progress = new ReindexProgressInfo($numSucceeded, $numFailed, $numRemaining);
        $response = new ReIndexResponse(ReIndexStatus::STARTED(), $progress);
        $this->assertEquals($progress, $response->getProgress());
        $this->assertEquals(ReIndexStatus::STARTED(), $response->getStatus());
        $response = new ReIndexResponse(ReIndexStatus::STARTED());
        $response->setProgress($progress)
            ->setStatus(ReIndexStatus::RUNNING());
        $this->assertEquals($progress, $response->getProgress());
        $this->assertEquals(ReIndexStatus::RUNNING(), $response->getStatus());

        $body = new ReIndexBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new ReIndexBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new ReIndexEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new ReIndexEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:ReIndexRequest action="start">
            <mbox id="$id" types="$types" ids="$ids" />
        </urn:ReIndexRequest>
        <urn:ReIndexResponse status="running">
            <progress numSucceeded="$numSucceeded" numFailed="$numFailed" numRemaining="$numRemaining" />
        </urn:ReIndexResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ReIndexEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'ReIndexRequest' => [
                    'action' => 'start',
                    'mbox' => [
                        'id' => $id,
                        'types' => $types,
                        'ids' => $ids,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'ReIndexResponse' => [
                    'status' => 'running',
                    'progress' => [
                        'numSucceeded' => $numSucceeded,
                        'numFailed' => $numFailed,
                        'numRemaining' => $numRemaining,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, ReIndexEnvelope::class, 'json'));
    }
}
