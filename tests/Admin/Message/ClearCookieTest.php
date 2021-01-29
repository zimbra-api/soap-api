<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\ClearCookieBody;
use Zimbra\Admin\Message\ClearCookieEnvelope;
use Zimbra\Admin\Message\ClearCookieRequest;
use Zimbra\Admin\Message\ClearCookieResponse;
use Zimbra\Admin\Struct\CookieSpec;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for ClearCookie.
 */
class ClearCookieTest extends ZimbraStructTestCase
{
    public function testClearCookie()
    {
        $name = $this->faker->word;
        $cookie = new CookieSpec($name);
        $request = new ClearCookieRequest(
            [$cookie]
        );
        $this->assertSame([$cookie], $request->getCookies());

        $request = new ClearCookieRequest();
        $request->setCookies([$cookie])
            ->addCookie($cookie);
        $this->assertSame([$cookie, $cookie], $request->getCookies());
        $request->setCookies([$cookie]);

        $response = new ClearCookieResponse();

        $body = new ClearCookieBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new ClearCookieBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new ClearCookieEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new ClearCookieEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:ClearCookieRequest>
            <cookie name="$name" />
        </urn:ClearCookieRequest>
        <urn:ClearCookieResponse />
    </soap:Body>
</soap:Envelope>
EOT;
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
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, ClearCookieEnvelope::class, 'json'));
    }
}
