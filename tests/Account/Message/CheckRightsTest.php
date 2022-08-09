<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Message;

use Zimbra\Account\Message\{
    CheckRightsEnvelope,
    CheckRightsBody,
    CheckRightsRequest,
    CheckRightsResponse};
use Zimbra\Account\Struct\{
    CheckRightsRightInfo,
    CheckRightsTargetInfo,
    CheckRightsTargetSpec
};
use Zimbra\Common\Enum\{TargetType, TargetBy};
use Zimbra\Tests\ZimbraTestCase;
/**
 * Testcase class for CheckRights.
 */
class CheckRightsTest extends ZimbraTestCase
{
    public function testCheckRights()
    {
        $key1 = $this->faker->unique->word;
        $key2 = $this->faker->unique->word;
        $right1 = $this->faker->unique->word;
        $right2 = $this->faker->unique->word;

        $targetSpec = new CheckRightsTargetSpec(
            TargetType::ACCOUNT(), TargetBy::NAME(), $key1, [$right1]
        );
        $rightInfo = new CheckRightsRightInfo($right2, TRUE);
        $targetInfo = new CheckRightsTargetInfo(
            TargetType::ACCOUNT(), TargetBy::NAME(), $key2, TRUE, [$rightInfo]
        );

        $request = new CheckRightsRequest([$targetSpec]);
        $this->assertSame([$targetSpec], $request->getTargets());

        $request = new CheckRightsRequest();
        $request->setTargets([$targetSpec])
            ->addTarget($targetSpec);
        $this->assertSame([$targetSpec, $targetSpec], $request->getTargets());
        $request->setTargets([$targetSpec]);

        $response = new CheckRightsResponse([$targetInfo]);
        $this->assertSame([$targetInfo], $response->getTargets());

        $response = new CheckRightsResponse();
        $response->setTargets([$targetInfo]);
        $this->assertSame([$targetInfo], $response->getTargets());

        $body = new CheckRightsBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new CheckRightsBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new CheckRightsEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CheckRightsEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:CheckRightsRequest>
            <urn:target type="account" by="name" key="$key1">
                <urn:right>$right1</urn:right>
            </urn:target>
        </urn:CheckRightsRequest>
        <urn:CheckRightsResponse>
            <urn:target type="account" by="name" key="$key2" allow="true">
                <urn:right allow="true">$right2</urn:right>
            </urn:target>
        </urn:CheckRightsResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CheckRightsEnvelope::class, 'xml'));
    }
}
