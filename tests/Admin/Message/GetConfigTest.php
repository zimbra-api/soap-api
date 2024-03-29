<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\GetConfigBody;
use Zimbra\Admin\Message\GetConfigEnvelope;
use Zimbra\Admin\Message\GetConfigRequest;
use Zimbra\Admin\Message\GetConfigResponse;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetConfigTest.
 */
class GetConfigTest extends ZimbraTestCase
{
    public function testGetConfig()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $attr = new Attr($key, $value);

        $request = new GetConfigRequest($attr);
        $this->assertSame($attr, $request->getAttr());
        $request = new GetConfigRequest();
        $request->setAttr($attr);
        $this->assertSame($attr, $request->getAttr());

        $response = new GetConfigResponse([$attr]);

        $body = new GetConfigBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetConfigBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetConfigEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetConfigEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetConfigRequest>
            <urn:a n="$key">$value</urn:a>
        </urn:GetConfigRequest>
        <urn:GetConfigResponse>
            <urn:a n="$key">$value</urn:a>
        </urn:GetConfigResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetConfigEnvelope::class, 'xml'));
    }
}
