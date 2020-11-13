<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\AddAccountAliasResponse;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AddAccountAliasResponse.
 */
class AddAccountAliasResponseTest extends ZimbraStructTestCase
{
    public function testAddAccountAliasResponse()
    {
        $res = new AddAccountAliasResponse();

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AddAccountAliasResponse />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));
        $this->assertEquals($res, $this->serializer->deserialize($xml, AddAccountAliasResponse::class, 'xml'));

        $json = '{}';
        $this->assertSame($json, $this->serializer->serialize($res, 'json'));
        $this->assertEquals($res, $this->serializer->deserialize($json, AddAccountAliasResponse::class, 'json'));
    }
}
