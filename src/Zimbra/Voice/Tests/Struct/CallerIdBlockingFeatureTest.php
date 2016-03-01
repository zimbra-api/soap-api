<?php

namespace Zimbra\Struct\Tests;

use Zimbra\Voice\Struct\CallerIdBlockingFeature;

/**
 * Testcase class for CallerIdBlockingFeature.
 */
class CallerIdBlockingFeatureTest extends ZimbraStructTestCase
{
    public function testCallerIdBlockingFeature()
    {
        $calleridblocking = new CallerIdBlockingFeature(true, false);
        $this->assertInstanceOf('\Zimbra\Voice\Struct\CallFeatureInfo', $calleridblocking);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<calleridblocking s="true" a="false" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $calleridblocking);

        $array = [
            'calleridblocking' => [
                's' => true,
                'a' => false,
            ],
        ];
        $this->assertEquals($array, $calleridblocking->toArray());
    }
}
