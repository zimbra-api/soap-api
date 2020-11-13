<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CheckPasswordStrengthResponse;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CheckPasswordStrengthResponse.
 */
class CheckPasswordStrengthResponseTest extends ZimbraStructTestCase
{
    public function testCheckPasswordStrengthResponse()
    {
        $res = new CheckPasswordStrengthResponse();

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CheckPasswordStrengthResponse />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));
        $this->assertEquals($res, $this->serializer->deserialize($xml, CheckPasswordStrengthResponse::class, 'xml'));

        $json = '{}';
        $this->assertSame($json, $this->serializer->serialize($res, 'json'));
        $this->assertEquals($res, $this->serializer->deserialize($json, CheckPasswordStrengthResponse::class, 'json'));
    }
}
