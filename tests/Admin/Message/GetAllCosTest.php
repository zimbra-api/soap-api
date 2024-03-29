<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\GetAllCosBody;
use Zimbra\Admin\Message\GetAllCosEnvelope;
use Zimbra\Admin\Message\GetAllCosRequest;
use Zimbra\Admin\Message\GetAllCosResponse;
use Zimbra\Admin\Struct\CosInfo;
use Zimbra\Admin\Struct\CosInfoAttr;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetAllCosTest.
 */
class GetAllCosTest extends ZimbraTestCase
{
    public function testGetAllCos()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $cos = new CosInfo($name, $id, TRUE, [new CosInfoAttr($key, $value, TRUE, FALSE)]);

        $request = new GetAllCosRequest();

        $response = new GetAllCosResponse([$cos]);
        $this->assertSame([$cos], $response->getCosList());
        $response = new GetAllCosResponse();
        $response->setCosList([$cos]);
        $this->assertSame([$cos], $response->getCosList());

        $body = new GetAllCosBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetAllCosBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetAllCosEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetAllCosEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetAllCosRequest />
        <urn:GetAllCosResponse>
            <urn:cos name="$name" id="$id" isDefaultCos="true">
                <urn:a n="$key" c="true" pd="false">$value</urn:a>
            </urn:cos>
        </urn:GetAllCosResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetAllCosEnvelope::class, 'xml'));
    }
}
