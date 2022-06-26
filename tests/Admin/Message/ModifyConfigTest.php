<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\ModifyConfigBody;
use Zimbra\Admin\Message\ModifyConfigEnvelope;
use Zimbra\Admin\Message\ModifyConfigRequest;
use Zimbra\Admin\Message\ModifyConfigResponse;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ModifyConfig.
 */
class ModifyConfigTest extends ZimbraTestCase
{
    public function testModifyConfig()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;

        $request = new ModifyConfigRequest([new Attr($key, $value)]);
        $response = new ModifyConfigResponse();

        $body = new ModifyConfigBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new ModifyConfigBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new ModifyConfigEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new ModifyConfigEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:ModifyConfigRequest>
            <urn:a n="$key">$value</urn:a>
        </urn:ModifyConfigRequest>
        <urn:ModifyConfigResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ModifyConfigEnvelope::class, 'xml'));
    }
}
