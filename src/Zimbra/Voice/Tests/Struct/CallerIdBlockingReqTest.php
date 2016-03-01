<?php

namespace Zimbra\Struct\Tests;

use Zimbra\Voice\Struct\CallerIdBlockingReq;

/**
 * Testcase class for CallerIdBlockingReq.
 */
class CallerIdBlockingReqTest extends ZimbraStructTestCase
{
    public function testCallerIdBlockingReq()
    {
        $calleridblocking = new CallerIdBlockingReq();
        $this->assertInstanceOf('\Zimbra\Voice\Struct\CallFeatureReq', $calleridblocking);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<calleridblocking />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $calleridblocking);

        $array = [
            'calleridblocking' => [],
        ];
        $this->assertEquals($array, $calleridblocking->toArray());
    }
}
