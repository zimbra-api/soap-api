<?php

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\AddDistributionListAliasResponse;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AddDistributionListAliasResponse.
 */
class AddDistributionListAliasResponseTest extends ZimbraStructTestCase
{
    public function testAddDistributionListAliasResponse()
    {
        $res = new AddDistributionListAliasResponse();

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AddDistributionListAliasResponse xmlns="urn:zimbraAdmin" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));

        $res = $this->serializer->deserialize($xml, 'Zimbra\Admin\Message\AddDistributionListAliasResponse', 'xml');
        $this->assertTrue($res instanceof AddDistributionListAliasResponse);
    }
}
