<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Message;

use Zimbra\Account\Message\SubscribeDistributionListEnvelope;
use Zimbra\Account\Message\SubscribeDistributionListBody;
use Zimbra\Account\Message\SubscribeDistributionListRequest;
use Zimbra\Account\Message\SubscribeDistributionListResponse;

use Zimbra\Common\Enum\DistributionListBy as DLBy;
use Zimbra\Common\Enum\DistributionListSubscribeOp as SubscribeOp;
use Zimbra\Common\Enum\DistributionListSubscribeStatus as SubscribeStatus;
use Zimbra\Common\Struct\DistributionListSelector;

use Zimbra\Tests\ZimbraTestCase;
/**
 * Testcase class for SubscribeDistributionList.
 */
class SubscribeDistributionListTest extends ZimbraTestCase
{
    public function testSubscribeDistributionList()
    {
        $value = $this->faker->word;
        $op = SubscribeOp::SUBSCRIBE;
        $status = SubscribeStatus::SUBSCRIBED;

        $dl = new DistributionListSelector(DLBy::NAME, $value);

        $request = new SubscribeDistributionListRequest($dl, $op);
        $this->assertSame($dl, $request->getDl());
        $this->assertSame($op, $request->getOp());

        $request = new SubscribeDistributionListRequest(new DistributionListSelector());
        $request->setDl($dl)
            ->setOp($op);
        $this->assertSame($dl, $request->getDl());
        $this->assertSame($op, $request->getOp());

        $response = new SubscribeDistributionListResponse($status);
        $this->assertSame($status, $response->getStatus());
        $response = new SubscribeDistributionListResponse();
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
            <urn:dl by="name">$value</urn:dl>
        </urn:SubscribeDistributionListRequest>
        <urn:SubscribeDistributionListResponse status="subscribed" />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, SubscribeDistributionListEnvelope::class, 'xml'));
    }
}
