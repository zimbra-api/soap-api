<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CheckHealthRequest;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CheckHealthRequest.
 */
class CheckHealthRequestTest extends ZimbraStructTestCase
{
    public function testCheckHealthRequest()
    {
        $req = new CheckHealthRequest();

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CheckHealthRequest />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, CheckHealthRequest::class, 'xml'));

        $json = '{}';
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, CheckHealthRequest::class, 'json'));
    }
}
