<?php

namespace Zimbra\Struct\Tests;

use Zimbra\Voice\Struct\CallWaitingReq;

/**
 * Testcase class for CallWaitingReq.
 */
class CallWaitingReqTest extends ZimbraStructTestCase
{
    public function testCallWaitingReq()
    {
        $callwaiting = new CallWaitingReq();
        $this->assertInstanceOf('\Zimbra\Voice\Struct\CallFeatureReq', $callwaiting);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<callwaiting />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $callwaiting);

        $array = [
            'callwaiting' => [],
        ];
        $this->assertEquals($array, $callwaiting->toArray());
    }
}
