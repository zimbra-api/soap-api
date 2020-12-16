<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\{GetUCServiceBody, GetUCServiceEnvelope, GetUCServiceRequest, GetUCServiceResponse};
use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\UCServiceInfo;
use Zimbra\Admin\Struct\UcServiceSelector;
use Zimbra\Enum\UcServiceBy;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for GetUCService.
 */
class GetUCServiceTest extends ZimbraStructTestCase
{
    public function testGetUCService()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $attr1 = $this->faker->word;
        $attr2 = $this->faker->word;
        $attr3 = $this->faker->word;
        $attrs = implode(',', [$attr1, $attr2, $attr3]);

        $ucs = new UcServiceSelector(UcServiceBy::NAME(), $value);
        $uci = new UCServiceInfo($name, $id, [new Attr($key, $value)]);

        $request = new GetUCServiceRequest($ucs, $attrs);
        $this->assertSame($ucs, $request->getUCService());
        $this->assertSame($attrs, $request->getAttrs());

        $request = new GetUCServiceRequest(new UcServiceSelector(UcServiceBy::ID(), ''));
        $request->setUCService($ucs)
            ->setAttrs($attr1)
            ->addAttrs($attr2, $attr3);
        $this->assertSame($ucs, $request->getUCService());
        $this->assertSame($attrs, $request->getAttrs());

        $response = new GetUCServiceResponse($uci);
        $this->assertSame($uci, $response->getUCService());
        $response = new GetUCServiceResponse(new UCServiceInfo('', ''));
        $response->setUCService($uci);
        $this->assertSame($uci, $response->getUCService());

        $body = new GetUCServiceBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new GetUCServiceBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetUCServiceEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new GetUCServiceEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetUCServiceRequest attrs="$attrs">
            <ucservice by="name">$value</ucservice>
        </urn:GetUCServiceRequest>
        <urn:GetUCServiceResponse>
            <ucservice name="$name" id="$id">
                <a n="$key">$value</a>
            </ucservice>
        </urn:GetUCServiceResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetUCServiceEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'GetUCServiceRequest' => [
                    'attrs' => $attrs,
                    'ucservice' => [
                        'by' => 'name',
                        '_content' => $value,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'GetUCServiceResponse' => [
                    'ucservice' => [
                        'name' => $name,
                        'id' => $id,
                        'a' => [
                            [
                                'n' => $key,
                                '_content' => $value,
                            ],
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, GetUCServiceEnvelope::class, 'json'));
    }
}
