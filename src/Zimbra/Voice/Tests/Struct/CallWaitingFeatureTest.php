<?php

namespace Zimbra\Struct\Tests;

use Zimbra\Voice\Struct\CallWaitingFeature;

/**
 * Testcase class for CallWaitingFeature.
 */
class CallWaitingFeatureTest extends ZimbraStructTestCase
{
    public function testCallWaitingFeature()
    {
        $callwaiting = new CallWaitingFeature(true, false);
        $this->assertInstanceOf('\Zimbra\Voice\Struct\CallFeatureInfo', $callwaiting);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<callwaiting s="true" a="false" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $callwaiting);

        $array = [
            'callwaiting' => [
                's' => true,
                'a' => false,
            ],
        ];
        $this->assertEquals($array, $callwaiting->toArray());
    }
}
