<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\ConfigureZimletBody;
use Zimbra\Admin\Message\ConfigureZimletEnvelope;
use Zimbra\Admin\Message\ConfigureZimletRequest;
use Zimbra\Admin\Message\ConfigureZimletResponse;
use Zimbra\Admin\Struct\AttachmentIdAttrib;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ConfigureZimlet.
 */
class ConfigureZimletTest extends ZimbraTestCase
{
    public function testConfigureZimlet()
    {
        $aid = $this->faker->uuid;
        $content = new AttachmentIdAttrib($aid);
        $request = new ConfigureZimletRequest($content);
        $this->assertSame($content, $request->getContent());

        $request = new ConfigureZimletRequest(new AttachmentIdAttrib(''));
        $request->setContent($content);
        $this->assertSame($content, $request->getContent());

        $response = new ConfigureZimletResponse();

        $body = new ConfigureZimletBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new ConfigureZimletBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new ConfigureZimletEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new ConfigureZimletEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:ConfigureZimletRequest>
            <content aid="$aid" />
        </urn:ConfigureZimletRequest>
        <urn:ConfigureZimletResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ConfigureZimletEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'ConfigureZimletRequest' => [
                    'content' => [
                        'aid' => $aid,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'ConfigureZimletResponse' => [
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, ConfigureZimletEnvelope::class, 'json'));
    }
}
