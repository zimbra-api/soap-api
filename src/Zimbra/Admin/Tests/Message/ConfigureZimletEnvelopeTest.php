<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\ConfigureZimletBody;
use Zimbra\Admin\Message\ConfigureZimletEnvelope;
use Zimbra\Admin\Message\ConfigureZimletRequest;
use Zimbra\Admin\Message\ConfigureZimletResponse;
use Zimbra\Admin\Struct\AttachmentIdAttrib;
use Zimbra\Soap\Header;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ConfigureZimletEnvelope.
 */
class ConfigureZimletEnvelopeTest extends ZimbraStructTestCase
{
    public function testConfigureZimletEnvelope()
    {
        $aid = $this->faker->uuid;
        $content = new AttachmentIdAttrib($aid);
        $request = new ConfigureZimletRequest($content);
        $response = new ConfigureZimletResponse();
        $body = new ConfigureZimletBody($request, $response);

        $envelope = new ConfigureZimletEnvelope(new Header(), $body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new ConfigureZimletEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:ConfigureZimletRequest>'
                        . '<content aid="' . $aid . '" />'
                    . '</urn:ConfigureZimletRequest>'
                    . '<urn:ConfigureZimletResponse />'
                . '</soap:Body>'
            . '</soap:Envelope>';
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
        $this->assertSame($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, ConfigureZimletEnvelope::class, 'json'));
    }
}
