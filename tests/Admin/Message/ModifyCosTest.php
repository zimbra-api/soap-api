<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\ModifyCosBody;
use Zimbra\Admin\Message\ModifyCosEnvelope;
use Zimbra\Admin\Message\ModifyCosRequest;
use Zimbra\Admin\Message\ModifyCosResponse;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\CosInfo;
use Zimbra\Admin\Struct\CosInfoAttr;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ModifyCos.
 */
class ModifyCosTest extends ZimbraTestCase
{
    public function testModifyCos()
    {
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;

        $request = new ModifyCosRequest(
            $id, [new Attr($key, $value)]
        );
        $this->assertSame($id, $request->getId());
        $request = new ModifyCosRequest();
        $request->setId($id)
            ->setAttrs([new Attr($key, $value)]);
        $this->assertSame($id, $request->getId());

        $cos = new CosInfo($name, $id, TRUE, [new CosInfoAttr($key, $value, TRUE, TRUE)]);
        $response = new ModifyCosResponse($cos);
        $this->assertSame($cos, $response->getCos());
        $response = new ModifyCosResponse();
        $response->setCos($cos);
        $this->assertSame($cos, $response->getCos());

        $body = new ModifyCosBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new ModifyCosBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new ModifyCosEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new ModifyCosEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:ModifyCosRequest>
            <urn:id>$id</urn:id>
            <urn:a n="$key">$value</urn:a>
        </urn:ModifyCosRequest>
        <urn:ModifyCosResponse>
            <urn:cos name="$name" id="$id" isDefaultCos="true">
                <urn:a n="$key" c="true" pd="true">$value</urn:a>
            </urn:cos>
        </urn:ModifyCosResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ModifyCosEnvelope::class, 'xml'));
    }
}
