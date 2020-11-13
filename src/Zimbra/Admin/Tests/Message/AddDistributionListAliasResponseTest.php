<?php declare(strict_types=1);

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
            . '<AddDistributionListAliasResponse />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));
        $this->assertEquals($res, $this->serializer->deserialize($xml, AddDistributionListAliasResponse::class, 'xml'));

        $json = '{}';
        $this->assertSame($json, $this->serializer->serialize($res, 'json'));
        $this->assertEquals($res, $this->serializer->deserialize($json, AddDistributionListAliasResponse::class, 'json'));
    }
}
