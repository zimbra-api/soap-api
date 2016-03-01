<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\ClearCookie;
use Zimbra\Admin\Struct\CookieSpec;

/**
 * Testcase class for ClearCookie.
 */
class ClearCookieTest extends ZimbraAdminApiTestCase
{
    public function testClearCookieRequest()
    {
        $name = $this->faker->word;
        $cookie = new CookieSpec($name);
        $req = new ClearCookie([$cookie]);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame([$cookie], $req->getCookies()->all());

        $req->addCookie($cookie);
        $this->assertSame([$cookie, $cookie], $req->getCookies()->all());
        $req->getCookies()->remove(1);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ClearCookieRequest>'
                . '<cookie name="' . $name . '" />'
            . '</ClearCookieRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ClearCookieRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'cookie' => [
                    [
                        'name' => $name
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testClearCookieApi()
    {
        $name = $this->faker->word;
        $cookie = new CookieSpec($name);

        $this->api->clearCookie(
            [$cookie]
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:ClearCookieRequest>'
                        . '<urn1:cookie name="' . $name . '" />'
                    . '</urn1:ClearCookieRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
