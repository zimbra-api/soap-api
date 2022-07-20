<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\CreateCosBody;
use Zimbra\Admin\Message\CreateCosEnvelope;
use Zimbra\Admin\Message\CreateCosRequest;
use Zimbra\Admin\Message\CreateCosResponse;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\CosInfo;
use Zimbra\Admin\Struct\CosInfoAttr;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CreateCos.
 */
class CreateCosTest extends ZimbraTestCase
{
    public function testCreateCos()
    {
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;

        $request = new CreateCosRequest(
            $name, [new Attr($key, $value)]
        );
        $this->assertSame($name, $request->getName());
        $request = new CreateCosRequest();
        $request->setName($name)
            ->setAttrs([new Attr($key, $value)]);
        $this->assertSame($name, $request->getName());

        $cos = new CosInfo($name, $id, TRUE, [new CosInfoAttr($key, $value, TRUE, TRUE)]);
        $response = new CreateCosResponse($cos);
        $this->assertSame($cos, $response->getCos());
        $response = new CreateCosResponse();
        $response->setCos($cos);
        $this->assertSame($cos, $response->getCos());

        $body = new CreateCosBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new CreateCosBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new CreateCosEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CreateCosEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:CreateCosRequest>
            <urn:name>$name</urn:name>
            <urn:a n="$key">$value</urn:a>
        </urn:CreateCosRequest>
        <urn:CreateCosResponse>
            <urn:cos name="$name" id="$id" isDefaultCos="true">
                <urn:a n="$key" c="true" pd="true">$value</urn:a>
            </urn:cos>
        </urn:CreateCosResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CreateCosEnvelope::class, 'xml'));
    }
}
