<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\ClearCookieBody;
use Zimbra\Admin\Message\ClearCookieRequest;
use Zimbra\Admin\Message\ClearCookieResponse;
use Zimbra\Admin\Struct\CookieSpec;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ClearCookieBody.
 */
class ClearCookieBodyTest extends ZimbraStructTestCase
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
}
