<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Message;

use Zimbra\Account\Message\SubscribeDistributionListEnvelope;
use Zimbra\Account\Message\SubscribeDistributionListBody;
use Zimbra\Account\Message\SubscribeDistributionListRequest;
use Zimbra\Account\Message\SubscribeDistributionListResponse;

use Zimbra\Enum\DistributionListBy as DLBy;
use Zimbra\Enum\DistributionListSubscribeOp as SubscribeOp;
use Zimbra\Enum\DistributionListSubscribeStatus as SubscribeStatus;
use Zimbra\Struct\DistributionListSelector;

use Zimbra\Tests\Struct\ZimbraStructTestCase;
/**
 * Testcase class for SubscribeDistributionList.
 */
class SubscribeDistributionListTest extends ZimbraStructTestCase
{
    public function testSubscribeDistributionList()
    {
        $value = $this->faker->word;
        $op = SubscribeOp::SUBSCRIBE();
        $status = SubscribeStatus::SUBSCRIBED();

        $dl = new DistributionListSelector(DLBy::NAME(), $value);

        $request = new SubscribeDistributionListRequest($dl, $op);
        $this->assertSame($dl, $request->getDl());
        $this->assertSame($op, $request->getOp());

        $request = new SubscribeDistributionListRequest(new DistributionListSelector(DLBy::NAME(), ''), SubscribeOp::UNSUBSCRIBE());
        $request->setDl($dl)
            ->setOp($op);
        $this->assertSame($dl, $request->getDl());
        $this->assertSame($op, $request->getOp());

        $response = new SubscribeDistributionListResponse($status);
        $this->assertSame($status, $response->getStatus());
        $response = new SubscribeDistributionListResponse(SubscribeStatus::UNSUBSCRIBED());
        $response->setStatus($status);
        $this->assertEquals($status, $response->getStatus());

        $body = new SubscribeDistributionListBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new SubscribeDistributionListBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new SubscribeDistributionListEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new SubscribeDistributionListEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:SubscribeDistributionListRequest op="subscribe">
            <dl by="name">$value</dl>
        </urn:SubscribeDistributionListRequest>
        <urn:SubscribeDistributionListResponse status="subscribed" />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, SubscribeDistributionListEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'SubscribeDistributionListRequest' => [
                    'op' => 'subscribe',
                    'dl' => [
                        'by' => 'name',
                        '_content' => $value,
                    ],
                    '_jsns' => 'urn:zimbraAccount',
                ],
                'SubscribeDistributionListResponse' => [
                    'status' => 'subscribed',
                    '_jsns' => 'urn:zimbraAccount',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, SubscribeDistributionListEnvelope::class, 'json'));
    }
}
