<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\ConfigureZimletResponse;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ConfigureZimletResponse.
 */
class ConfigureZimletResponseTest extends ZimbraStructTestCase
{
    public function testConfigureZimletResponse()
    {
        $res = new ConfigureZimletResponse();

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ConfigureZimletResponse />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));
        $this->assertEquals($res, $this->serializer->deserialize($xml, ConfigureZimletResponse::class, 'xml'));

        $json = '{}';
        $this->assertSame($json, $this->serializer->serialize($res, 'json'));
        $this->assertEquals($res, $this->serializer->deserialize($json, ConfigureZimletResponse::class, 'json'));
    }
}
