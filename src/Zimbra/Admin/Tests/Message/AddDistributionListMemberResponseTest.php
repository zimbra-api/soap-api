<?php

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\AddDistributionListMemberResponse;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AddDistributionListMemberResponse.
 */
class AddDistributionListMemberResponseTest extends ZimbraStructTestCase
{
    public function testAddDistributionListMemberResponse()
    {
        $res = new AddDistributionListMemberResponse();

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AddDistributionListMemberResponse xmlns="urn:zimbraAdmin" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));

        $res = $this->serializer->deserialize($xml, 'Zimbra\Admin\Message\AddDistributionListMemberResponse', 'xml');
        $this->assertTrue($res instanceof AddDistributionListMemberResponse);
    }
}
