<?php

namespace Zimbra\Struct\Tests;

use Zimbra\Voice\Struct\SelectiveCallAcceptanceReq;

/**
 * Testcase class for SelectiveCallAcceptanceReq.
 */
class SelectiveCallAcceptanceReqTest extends ZimbraStructTestCase
{
    public function testSelectiveCallAcceptanceReq()
    {
        $selectivecallacceptance = new SelectiveCallAcceptanceReq();
        $this->assertInstanceOf('\Zimbra\Voice\Struct\CallFeatureReq', $selectivecallacceptance);
        $xml = '<?xml version="1.0"?>'."\n"
            .'<selectivecallacceptance />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $selectivecallacceptance);

        $array = [
            'selectivecallacceptance' => [],
        ];
        $this->assertEquals($array, $selectivecallacceptance->toArray());
    }
}
