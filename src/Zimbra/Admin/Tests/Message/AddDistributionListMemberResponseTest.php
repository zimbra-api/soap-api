<?php declare(strict_types=1);

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
            . '<AddDistributionListMemberResponse />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));
        $this->assertEquals($res, $this->serializer->deserialize($xml, AddDistributionListMemberResponse::class, 'xml'));

        $json = json_encode(new \stdClass);
        $this->assertSame($json, $this->serializer->serialize($res, 'json'));
        $this->assertEquals($res, $this->serializer->deserialize($json, AddDistributionListMemberResponse::class, 'json'));
    }
}
