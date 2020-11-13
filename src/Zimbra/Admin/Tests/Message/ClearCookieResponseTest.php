<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\ClearCookieResponse;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ClearCookieResponse.
 */
class ClearCookieResponseTest extends ZimbraStructTestCase
{
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
}
