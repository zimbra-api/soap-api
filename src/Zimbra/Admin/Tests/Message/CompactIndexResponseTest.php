<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CompactIndexResponse;
use Zimbra\Enum\CompactIndexStatus;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CompactIndexResponse.
 */
class CompactIndexResponseTest extends ZimbraStructTestCase
{
    public function testCompactIndexResponse()
    {
        $res = new CompactIndexResponse(CompactIndexStatus::STARTED());
        $this->assertEquals(CompactIndexStatus::STARTED(), $res->getStatus());

        $res = new CompactIndexResponse(CompactIndexStatus::STARTED());
        $res->setStatus(CompactIndexStatus::RUNNING());
        $this->assertEquals(CompactIndexStatus::RUNNING(), $res->getStatus());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CompactIndexResponse status="' . CompactIndexStatus::RUNNING() . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));
        $this->assertEquals($res, $this->serializer->deserialize($xml, CompactIndexResponse::class, 'xml'));

        $json = json_encode([
            'status' => (string) CompactIndexStatus::RUNNING(),
        ]);
        $this->assertSame($json, $this->serializer->serialize($res, 'json'));
        $this->assertEquals($res, $this->serializer->deserialize($json, CompactIndexResponse::class, 'json'));
    }
}
