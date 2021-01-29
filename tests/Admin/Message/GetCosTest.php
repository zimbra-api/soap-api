<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\{GetCosBody, GetCosEnvelope, GetCosRequest, GetCosResponse};
use Zimbra\Admin\Struct\CosInfoAttr;
use Zimbra\Admin\Struct\CosInfo;
use Zimbra\Admin\Struct\CosSelector;
use Zimbra\Enum\CosBy;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for GetCos.
 */
class GetCosTest extends ZimbraStructTestCase
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

        $attr = new CosInfoAttr($key, $value, TRUE, FALSE);
        $cos = new CosSelector(CosBy::NAME(), $value);
        $cosInfo = new CosInfo($name, $id, TRUE, [$attr]);

        $request = new GetCosRequest($cos, $attrs);
        $this->assertSame($cos, $request->getCos());
        $this->assertSame($attrs, $request->getAttrs());

        $request = new GetCosRequest(new CosSelector(CosBy::ID(), ''));
        $request->setCos($cos)
            ->setAttrs($attr1)
            ->addAttrs($attr2, $attr3);
        $this->assertSame($cos, $request->getCos());
        $this->assertSame($attrs, $request->getAttrs());

        $response = new GetCosResponse(
            $cosInfo
        );
        $this->assertSame($cosInfo, $response->getCos());
        $response = new GetCosResponse(new CosInfo('', ''));
        $response->setCos($cosInfo);
        $this->assertSame($cosInfo, $response->getCos());

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
            <cos by="name">$value</cos>
        </urn:GetCosRequest>
        <urn:GetCosResponse>
            <cos name="$name" id="$id" isDefaultCos="true">
                <a n="$key" c="true" pd="false">$value</a>
            </cos>
        </urn:GetCosResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetCosEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'GetCosRequest' => [
                    'attrs' => $attrs,
                    'cos' => [
                        'by' => 'name',
                        '_content' => $value,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'GetCosResponse' => [
                    'cos' => [
                        'name' => $name,
                        'id' => $id,
                        'isDefaultCos' => TRUE,
                        'a' => [
                            [
                                'n' => $key,
                                '_content' => $value,
                                'c' => TRUE,
                                'pd' => FALSE,
                            ],
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, GetCosEnvelope::class, 'json'));
    }
}
