<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\{GetCosBody, GetCosEnvelope, GetCosRequest, GetCosResponse};
use Zimbra\Admin\Struct\CosInfoAttr;
use Zimbra\Admin\Struct\CosInfo;
use Zimbra\Admin\Struct\CosSelector;
use Zimbra\Common\Enum\CosBy;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetCos.
 */
class GetCosTest extends ZimbraTestCase
{
    public function testGetCos()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $attr1 = $this->faker->word;
        $attr2 = $this->faker->word;
        $attr3 = $this->faker->word;
        $attrs = implode(',', [$attr1, $attr2, $attr3]);

        $cos = new CosSelector(CosBy::NAME, $value);
        $request = new GetCosRequest($cos, $attrs);
        $this->assertSame($cos, $request->getCos());
        $this->assertSame($attrs, $request->getAttrs());
        $request = new GetCosRequest(new CosSelector());
        $request->setCos($cos)
            ->setAttrs($attr1)
            ->addAttrs($attr2, $attr3);
        $this->assertSame($cos, $request->getCos());
        $this->assertSame($attrs, $request->getAttrs());

        $cos = new CosInfo($name, $id, TRUE, [new CosInfoAttr($key, $value, TRUE, FALSE)]);
        $response = new GetCosResponse(
            $cos
        );
        $this->assertSame($cos, $response->getCos());
        $response = new GetCosResponse();
        $response->setCos($cos);
        $this->assertSame($cos, $response->getCos());

        $body = new GetCosBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new GetCosBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetCosEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new GetCosEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetCosRequest attrs="$attrs">
            <urn:cos by="name">$value</urn:cos>
        </urn:GetCosRequest>
        <urn:GetCosResponse>
            <urn:cos name="$name" id="$id" isDefaultCos="true">
                <urn:a n="$key" c="true" pd="false">$value</urn:a>
            </urn:cos>
        </urn:GetCosResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetCosEnvelope::class, 'xml'));
    }
}
