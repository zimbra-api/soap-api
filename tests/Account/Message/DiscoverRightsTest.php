<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Message;

use Zimbra\Account\Message\{DiscoverRightsEnvelope, DiscoverRightsBody, DiscoverRightsRequest, DiscoverRightsResponse};
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
        $name = $this->faker->name;
        $displayName = $this->faker->text;
        $addr = $this->faker->text;
        $right = $this->faker->name;
        $right1 = $this->faker->name;
        $right2 = $this->faker->name;

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
            <right>$right1</right>
            <right>$right2</right>
        </urn:DiscoverRightsRequest>
        <urn:DiscoverRightsResponse>
            <targets right="$right">
                <target type="$type" id="$id" name="$name" d="$displayName">
                    <email addr="$addr" />
                </target>
            </targets>
        </urn:DiscoverRightsResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, DiscoverRightsEnvelope::class, 'xml'));
    }
}
