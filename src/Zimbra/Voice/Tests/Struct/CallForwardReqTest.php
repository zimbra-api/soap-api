<?php

namespace Zimbra\Struct\Tests;

use Zimbra\Voice\Struct\CallForwardReq;

/**
 * Testcase class for CallForwardReq.
 */
class CallForwardReqTest extends ZimbraStructTestCase
{
    public function testCallForwardReq()
    {
        $callforward = new CallForwardReq();
        $this->assertInstanceOf('\Zimbra\Voice\Struct\CallFeatureReq', $callforward);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<callforward />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $callforward);

        $array = [
            'callforward' => [],
        ];
        $this->assertEquals($array, $callforward->toArray());
    }
}
