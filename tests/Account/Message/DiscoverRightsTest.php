<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Message;

use Zimbra\Account\Message\{
    DiscoverRightsEnvelope,
    DiscoverRightsBody,
    DiscoverRightsRequest,
    DiscoverRightsResponse
};
use Zimbra\Account\Struct\DiscoverRightsEmail;
use Zimbra\Account\Struct\DiscoverRightsInfo;
use Zimbra\Account\Struct\DiscoverRightsTarget;
use Zimbra\Common\Enum\TargetType;
use Zimbra\Tests\ZimbraTestCase;
/**
 * Testcase class for DiscoverRights.
 */
class DiscoverRightsTest extends ZimbraTestCase
{
    public function testDiscoverRights()
    {
        $type = TargetType::ACCOUNT();
        $id = $this->faker->uuid;
        $name = $this->faker->email;
        $displayName = $this->faker->name;
        $addr = $this->faker->email;
        $right = $this->faker->unique->word;
        $right1 = $this->faker->unique->word;
        $right2 = $this->faker->unique->word;

        $request = new DiscoverRightsRequest([$right1]);
        $this->assertSame([$right1], $request->getRights());

        $request = new DiscoverRightsRequest();
        $request->setRights([$right1])
            ->addRight($right2);
        $this->assertSame([$right1, $right2], $request->getRights());

        $target = new DiscoverRightsTarget($type, $id, $name, $displayName, [new DiscoverRightsEmail($addr)]);
        $targets = new DiscoverRightsInfo($right, [$target]);

        $response = new DiscoverRightsResponse([$targets]);
        $this->assertSame([$targets], $response->getDiscoveredRights());

        $response = new DiscoverRightsResponse();
        $response->setDiscoveredRights([$targets])
            ->addDiscoveredRight($targets);
        $this->assertSame([$targets, $targets], $response->getDiscoveredRights());
        $response->setDiscoveredRights([$targets]);

        $body = new DiscoverRightsBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new DiscoverRightsBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new DiscoverRightsEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new DiscoverRightsEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:DiscoverRightsRequest>
            <urn:right>$right1</urn:right>
            <urn:right>$right2</urn:right>
        </urn:DiscoverRightsRequest>
        <urn:DiscoverRightsResponse>
            <urn:targets right="$right">
                <urn:target type="$type" id="$id" name="$name" d="$displayName">
                    <urn:email addr="$addr" />
                </urn:target>
            </urn:targets>
        </urn:DiscoverRightsResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, DiscoverRightsEnvelope::class, 'xml'));
    }
}
