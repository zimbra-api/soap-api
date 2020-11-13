<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Response;

use Zimbra\Admin\Message\AutoProvTaskControlResponse;
use Zimbra\Enum\AutoProvTaskStatus;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AutoProvTaskControlResponse.
 */
class AutoProvTaskControlResponseTest extends ZimbraStructTestCase
{
    public function testAutoProvTaskControlResponse()
    {
        $res = new AutoProvTaskControlResponse(
            AutoProvTaskStatus::STARTED()
        );
        $this->assertEquals(AutoProvTaskStatus::STARTED(), $res->getStatus());
        $res->setStatus(AutoProvTaskStatus::RUNNING());
        $this->assertEquals(AutoProvTaskStatus::RUNNING(), $res->getStatus());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AutoProvTaskControlResponse status="' . AutoProvTaskStatus::RUNNING() . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));
        $this->assertEquals($res, $this->serializer->deserialize($xml, AutoProvTaskControlResponse::class, 'xml'));

        $json = json_encode([
            'status' => (string) AutoProvTaskStatus::RUNNING(),
        ]);
        $this->assertSame($json, $this->serializer->serialize($res, 'json'));
        $this->assertEquals($res, $this->serializer->deserialize($json, AutoProvTaskControlResponse::class, 'json'));
    }
}
