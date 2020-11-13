<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\ClearCookieBody;
use Zimbra\Admin\Message\ClearCookieEnvelope;
use Zimbra\Admin\Message\ClearCookieRequest;
use Zimbra\Admin\Message\ClearCookieResponse;
use Zimbra\Admin\Struct\CookieSpec;
use Zimbra\Soap\Header;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ClearCookieEnvelope.
 */
class ClearCookieEnvelopeTest extends ZimbraStructTestCase
{
    public function testClearCookieBody()
    {
        $name = $this->faker->word;
        $cookie = new CookieSpec($name);
        $request = new ClearCookieRequest(
            [$cookie]
        );
        $response = new ClearCookieResponse();
        $body = new ClearCookieBody($request, $response);

        $envelope = new ClearCookieEnvelope(new Header(), $body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new ClearCookieEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:ClearCookieRequest>'
                        . '<cookie name="' . $name . '" />'
                    . '</urn:ClearCookieRequest>'
                    . '<urn:ClearCookieResponse />'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ClearCookieEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'ClearCookieRequest' => [
                    'cookie' => [
                        [
                            'name' => $name,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'ClearCookieResponse' => [
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, ClearCookieEnvelope::class, 'json'));
    }
}
