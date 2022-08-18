<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\{GetUCServiceBody, GetUCServiceEnvelope, GetUCServiceRequest, GetUCServiceResponse};
use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\UCServiceInfo;
use Zimbra\Admin\Struct\UcServiceSelector;
use Zimbra\Common\Enum\UcServiceBy;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetUCService.
 */
class GetUCServiceTest extends ZimbraTestCase
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

        $ucservice = new UcServiceSelector(UcServiceBy::NAME, $value);
        $request = new GetUCServiceRequest($ucservice, $attrs);
        $this->assertSame($ucservice, $request->getUCService());
        $this->assertSame($attrs, $request->getAttrs());

        $request = new GetUCServiceRequest(new UcServiceSelector());
        $request->setUCService($ucservice)
            ->setAttrs($attr1)
            ->addAttrs($attr2, $attr3);
        $this->assertSame($ucservice, $request->getUCService());
        $this->assertSame($attrs, $request->getAttrs());

        $ucservice = new UCServiceInfo($name, $id, [new Attr($key, $value)]);
        $response = new GetUCServiceResponse($ucservice);
        $this->assertSame($ucservice, $response->getUCService());
        $response = new GetUCServiceResponse();
        $response->setUCService($ucservice);
        $this->assertSame($ucservice, $response->getUCService());

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
            <urn:ucservice by="name">$value</urn:ucservice>
        </urn:GetUCServiceRequest>
        <urn:GetUCServiceResponse>
            <urn:ucservice name="$name" id="$id">
                <urn:a n="$key">$value</urn:a>
            </urn:ucservice>
        </urn:GetUCServiceResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetUCServiceEnvelope::class, 'xml'));
    }
}
