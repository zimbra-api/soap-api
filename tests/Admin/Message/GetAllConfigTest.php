<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\GetAllConfigBody;
use Zimbra\Admin\Message\GetAllConfigEnvelope;
use Zimbra\Admin\Message\GetAllConfigRequest;
use Zimbra\Admin\Message\GetAllConfigResponse;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetAllConfigTest.
 */
class GetAllConfigTest extends ZimbraTestCase
{
    public function testGetAllConfig()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $attr = new Attr($key, $value);

        $request = new GetAllConfigRequest();
        $response = new GetAllConfigResponse([$attr]);

        $body = new GetAllConfigBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetAllConfigBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetAllConfigEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetAllConfigEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetAllConfigRequest />
        <urn:GetAllConfigResponse>
            <a n="$key">$value</a>
        </urn:GetAllConfigResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetAllConfigEnvelope::class, 'xml'));
    }
}
