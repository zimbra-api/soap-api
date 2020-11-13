<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Message\ClearCookieRequest;
use Zimbra\Admin\Struct\CookieSpec;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ClearCookieRequest.
 */
class ClearCookieRequestTest extends ZimbraStructTestCase
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
}
