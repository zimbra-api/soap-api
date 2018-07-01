<?php

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
            . '<AddAccountAliasResponse xmlns="urn:zimbraAdmin" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));

        $res = $this->serializer->deserialize($xml, 'Zimbra\Admin\Message\AddAccountAliasResponse', 'xml');
        $this->assertTrue($res instanceof AddAccountAliasResponse);
    }
}
