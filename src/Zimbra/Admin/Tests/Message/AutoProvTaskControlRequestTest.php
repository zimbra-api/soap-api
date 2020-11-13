<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Message\AutoProvTaskControlRequest;
use Zimbra\Enum\AutoProvTaskAction;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AutoProvTaskControlRequest.
 */
class AutoProvTaskControlRequestTest extends ZimbraStructTestCase
{
    public function testAutoProvTaskControlRequest()
    {
        $req = new AutoProvTaskControlRequest(
            AutoProvTaskAction::START()
        );
        $this->assertEquals(AutoProvTaskAction::START(), $req->getAction());
        $req->setAction(AutoProvTaskAction::STOP());
        $this->assertEquals(AutoProvTaskAction::STOP(), $req->getAction());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AutoProvTaskControlRequest action="' . AutoProvTaskAction::STOP() . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, AutoProvTaskControlRequest::class, 'xml'));

        $json = json_encode([
            'action' => (string) AutoProvTaskAction::STOP(),
        ]);
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, AutoProvTaskControlRequest::class, 'json'));
    }
}
