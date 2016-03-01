<?php

namespace Zimbra\Struct\Tests;

use Zimbra\Voice\Struct\SelectiveCallRejectionReq;

/**
 * Testcase class for SelectiveCallRejectionReq.
 */
class SelectiveCallRejectionReqTest extends ZimbraStructTestCase
{
    public function testSelectiveCallRejectionReq()
    {
        $selectivecallrejection = new SelectiveCallRejectionReq();
        $this->assertInstanceOf('\Zimbra\Voice\Struct\CallFeatureReq', $selectivecallrejection);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<selectivecallrejection />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $selectivecallrejection);

        $array = [
            'selectivecallrejection' => [],
        ];
        $this->assertEquals($array, $selectivecallrejection->toArray());
    }
}
