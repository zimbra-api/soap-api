<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\GetZimletStatusBody;
use Zimbra\Admin\Message\GetZimletStatusEnvelope;
use Zimbra\Admin\Message\GetZimletStatusRequest;
use Zimbra\Admin\Message\GetZimletStatusResponse;

use Zimbra\Admin\Struct\ZimletStatus;
use Zimbra\Admin\Struct\ZimletStatusCos;
use Zimbra\Admin\Struct\ZimletStatusParent;
use Zimbra\Common\Enum\ZimletStatusSetting;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetZimletStatusTest.
 */
class GetZimletStatusTest extends ZimbraTestCase
{
    public function testGetZimletStatus()
    {
        $name = $this->faker->name;
        $priority = $this->faker->randomNumber;

        $zimlet = new ZimletStatus($name, ZimletStatusSetting::ENABLED, TRUE, $priority);
        $zimlets = new ZimletStatusParent([$zimlet]);
        $cos = new ZimletStatusCos($name, [$zimlet]);

        $request = new GetZimletStatusRequest();

        $response = new GetZimletStatusResponse($zimlets, [$cos]);
        $this->assertSame($zimlets, $response->getZimlets());
        $this->assertSame([$cos], $response->getCoses());
        $response = new GetZimletStatusResponse();
        $response->setZimlets($zimlets)
            ->setCoses([$cos]);
        $this->assertSame($zimlets, $response->getZimlets());
        $this->assertSame([$cos], $response->getCoses());

        $body = new GetZimletStatusBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetZimletStatusBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetZimletStatusEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetZimletStatusEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetZimletStatusRequest />
        <urn:GetZimletStatusResponse>
            <urn:zimlets>
                <urn:zimlet name="$name" status="enabled" extension="true" priority="$priority" />
            </urn:zimlets>
            <urn:cos name="$name">
                <urn:zimlet name="$name" status="enabled" extension="true" priority="$priority" />
            </urn:cos>
        </urn:GetZimletStatusResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetZimletStatusEnvelope::class, 'xml'));
    }
}
