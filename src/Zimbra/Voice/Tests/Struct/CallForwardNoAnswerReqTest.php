<?php

namespace Zimbra\Struct\Tests;

use Zimbra\Voice\Struct\CallForwardNoAnswerReq;

/**
 * Testcase class for CallForwardNoAnswerReq.
 */
class CallForwardNoAnswerReqTest extends ZimbraStructTestCase
{
    public function testCallForwardNoAnswerReq()
    {
        $callforwardnoanswer = new CallForwardNoAnswerReq();
        $this->assertInstanceOf('\Zimbra\Voice\Struct\CallFeatureReq', $callforwardnoanswer);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<callforwardnoanswer />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $callforwardnoanswer);

        $array = [
            'callforwardnoanswer' => [],
        ];
        $this->assertEquals($array, $callforwardnoanswer->toArray());
    }
}
