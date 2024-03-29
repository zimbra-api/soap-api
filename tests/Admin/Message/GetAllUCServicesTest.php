<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\GetAllUCServicesBody;
use Zimbra\Admin\Message\GetAllUCServicesEnvelope;
use Zimbra\Admin\Message\GetAllUCServicesRequest;
use Zimbra\Admin\Message\GetAllUCServicesResponse;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\UCServiceInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetAllUCServicesTest.
 */
class GetAllUCServicesTest extends ZimbraTestCase
{
    public function testGetAllUCServices()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $ucservice = new UCServiceInfo($name, $id, [new Attr($key, $value)]);

        $request = new GetAllUCServicesRequest();

        $response = new GetAllUCServicesResponse([$ucservice]);
        $this->assertSame([$ucservice], $response->getUCServiceList());
        $response = new GetAllUCServicesResponse();
        $response->setUCServiceList([$ucservice]);
        $this->assertSame([$ucservice], $response->getUCServiceList());

        $body = new GetAllUCServicesBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetAllUCServicesBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetAllUCServicesEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetAllUCServicesEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetAllUCServicesRequest />
        <urn:GetAllUCServicesResponse>
            <urn:ucservice name="$name" id="$id">
                <urn:a n="$key">$value</urn:a>
            </urn:ucservice>
        </urn:GetAllUCServicesResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetAllUCServicesEnvelope::class, 'xml'));
    }
}
