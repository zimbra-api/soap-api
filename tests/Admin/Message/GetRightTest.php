<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\GetRightBody;
use Zimbra\Admin\Message\GetRightEnvelope;
use Zimbra\Admin\Message\GetRightRequest;
use Zimbra\Admin\Message\GetRightResponse;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\ComboRightInfo;
use Zimbra\Admin\Struct\ComboRights;
use Zimbra\Admin\Struct\RightsAttrs;
use Zimbra\Admin\Struct\RightInfo;
use Zimbra\Common\Enum\RightClass;
use Zimbra\Common\Enum\RightType;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetRightTest.
 */
class GetRightTest extends ZimbraTestCase
{
    public function testGetRight()
    {
        $right = $this->faker->word;
        $name = $this->faker->word;
        $targetType = $this->faker->word;
        $desc = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $request = new GetRightRequest($right, FALSE);
        $this->assertSame($right, $request->getRight());
        $this->assertFalse($request->getExpandAllAttrs());

        $request = new GetRightRequest();
        $request->setRight($right)
            ->setExpandAllAttrs(TRUE);
        $this->assertSame($right, $request->getRight());
        $this->assertTrue($request->getExpandAllAttrs());

        $rights = new ComboRights([new ComboRightInfo(
            $name, RightType::PRESET(), $targetType
        )]);
        $rightInfo = new RightInfo(
            $name, RightType::PRESET(), RightClass::ALL(), $desc, $targetType, new RightsAttrs(TRUE, [new Attr($key, $value)]), $rights
        );
        $response = new GetRightResponse($rightInfo);
        $this->assertSame($rightInfo, $response->getRight());
        $response = new GetRightResponse();
        $response->setRight($rightInfo);
        $this->assertSame($rightInfo, $response->getRight());

        $body = new GetRightBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetRightBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetRightEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetRightEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetRightRequest expandAllAttrs="true">
            <urn:right>$right</urn:right>
        </urn:GetRightRequest>
        <urn:GetRightResponse>
            <urn:right name="$name" type="preset" targetType="$targetType" rightClass="ALL">
                <urn:desc>$desc</urn:desc>
                <urn:attrs all="true">
                    <urn:a n="$key">$value</urn:a>
                </urn:attrs>
                <urn:rights>
                    <urn:r n="$name" type="preset" targetType="$targetType" />
                </urn:rights>
            </urn:right>
        </urn:GetRightResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetRightEnvelope::class, 'xml'));
    }
}
