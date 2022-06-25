<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\GetAllRightsBody;
use Zimbra\Admin\Message\GetAllRightsEnvelope;
use Zimbra\Admin\Message\GetAllRightsRequest;
use Zimbra\Admin\Message\GetAllRightsResponse;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\ComboRightInfo;
use Zimbra\Admin\Struct\ComboRights;
use Zimbra\Admin\Struct\RightsAttrs;
use Zimbra\Admin\Struct\RightInfo;
use Zimbra\Common\Enum\RightClass;
use Zimbra\Common\Enum\RightType;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetAllRightsTest.
 */
class GetAllRightsTest extends ZimbraTestCase
{
    public function testGetAllRights()
    {
        $name = $this->faker->word;
        $targetType = $this->faker->word;
        $desc = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $attrs = new RightsAttrs(TRUE, [new Attr($key, $value)]);
        $rights = new ComboRights([new ComboRightInfo(
            $name, RightType::PRESET(), $targetType
        )]);

        $right = new RightInfo($name, RightType::PRESET(), RightClass::ALL(), $desc, $targetType, $attrs, $rights);

        $request = new GetAllRightsRequest($targetType, FALSE, RightClass::ALL());
        $this->assertSame($targetType, $request->getTargetType());
        $this->assertFalse($request->isExpandAllAttrs());
        $this->assertEquals(RightClass::ALL(), $request->getRightClass());
        $request = new GetAllRightsRequest();
        $request->setTargetType($targetType)
             ->setExpandAllAttrs(TRUE)
             ->setRightClass(RightClass::ALL());
        $this->assertSame($targetType, $request->getTargetType());
        $this->assertTrue($request->isExpandAllAttrs());
        $this->assertEquals(RightClass::ALL(), $request->getRightClass());

        $response = new GetAllRightsResponse([$right]);
        $this->assertSame([$right], $response->getRights());

        $response = new GetAllRightsResponse();
        $response->setRights([$right])
            ->addRight($right);
        $this->assertSame([$right, $right], $response->getRights());
        $response->setRights([$right]);

        $body = new GetAllRightsBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetAllRightsBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetAllRightsEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetAllRightsEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetAllRightsRequest targetType="$targetType" expandAllAttrs="true" rightClass="ALL" />
        <urn:GetAllRightsResponse>
            <right name="$name" type="preset" targetType="$targetType" rightClass="ALL">
                <desc>$desc</desc>
                <attrs all="true">
                    <a n="$key">$value</a>
                </attrs>
                <rights>
                    <r n="$name" type="preset" targetType="$targetType" />
                </rights>
            </right>
        </urn:GetAllRightsResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetAllRightsEnvelope::class, 'xml'));
    }
}
