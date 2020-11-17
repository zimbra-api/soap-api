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
 * Testcase class for ClearCookie.
 */
class ClearCookieTest extends ZimbraStructTestCase
{
    public function testClearCookieRequest()
    {
        $name = $this->faker->word;
        $cookie = new CookieSpec($name);

        $req = new ClearCookieRequest(
            [$cookie]
        );
        $this->assertSame([$cookie], $req->getCookies());

        $req = new ClearCookieRequest();
        $req->setCookies([$cookie])
            ->addCookie($cookie);
        $this->assertSame([$cookie, $cookie], $req->getCookies());

        $req = new ClearCookieRequest(
            [$cookie]
        );
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ClearCookieRequest>'
                . '<cookie name="' . $name . '" />'
            . '</ClearCookieRequest>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, ClearCookieRequest::class, 'xml'));

        $json = json_encode([
            'cookie' => [
                [
                    'name' => $name,
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, ClearCookieRequest::class, 'json'));
    }

    public function testClearCookieResponse()
    {
        $res = new ClearCookieResponse();

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ClearCookieResponse />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));
        $this->assertEquals($res, $this->serializer->deserialize($xml, ClearCookieResponse::class, 'xml'));

        $json = json_encode(new \stdClass);
        $this->assertSame($json, $this->serializer->serialize($res, 'json'));
        $this->assertEquals($res, $this->serializer->deserialize($json, ClearCookieResponse::class, 'json'));
    }

    public function testClearCookieBody()
    {
        $name = $this->faker->word;
        $cookie = new CookieSpec($name);
        $request = new ClearCookieRequest(
            [$cookie]
        );
        $response = new ClearCookieResponse();

        $body = new ClearCookieBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new ClearCookieBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<Body xmlns:urn="urn:zimbraAdmin">'
                . '<urn:ClearCookieRequest>'
                    . '<cookie name="' . $name . '" />'
                . '</urn:ClearCookieRequest>'
                . '<urn:ClearCookieResponse />'
            . '</Body>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($body, 'xml'));
        $this->assertEquals($body, $this->serializer->deserialize($xml, ClearCookieBody::class, 'xml'));

        $json = json_encode([
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
        ]);
        $this->assertSame($json, $this->serializer->serialize($body, 'json'));
        $this->assertEquals($body, $this->serializer->deserialize($json, ClearCookieBody::class, 'json'));
    }

    public function testClearCookieEnvelope()
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
