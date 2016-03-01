<?php

namespace Zimbra\Struct\Tests;

use Zimbra\Voice\Struct\SelectiveCallForwardReq;

/**
 * Testcase class for SelectiveCallForwardReq.
 */
class SelectiveCallForwardReqTest extends ZimbraStructTestCase
{
    public function testSelectiveCallForwardReq()
    {
        $selectivecallforward = new SelectiveCallForwardReq();
        $this->assertInstanceOf('\Zimbra\Voice\Struct\CallFeatureReq', $selectivecallforward);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<selectivecallforward />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $selectivecallforward);

        $array = [
            'selectivecallforward' => [],
        ];
        $this->assertEquals($array, $selectivecallforward->toArray());
    }
}
