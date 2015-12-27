<?php

namespace Zimbra\Struct\Tests;

use Zimbra\Voice\Struct\CallForwardBusyLineReq;

/**
 * Testcase class for CallForwardBusyLineReq.
 */
class CallForwardBusyLineReqTest extends ZimbraStructTestCase
{
    public function testCallForwardBusyLineReq()
    {
        $callforwardbusyline = new CallForwardBusyLineReq();
        $this->assertInstanceOf('\Zimbra\Voice\Struct\CallFeatureReq', $callforwardbusyline);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<callforwardbusyline />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $callforwardbusyline);

        $array = [
            'callforwardbusyline' => [],
        ];
        $this->assertEquals($array, $callforwardbusyline->toArray());
    }
}
