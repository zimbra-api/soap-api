<?php

namespace Zimbra\Struct\Tests;

use Zimbra\Voice\Struct\AnonCallRejectionFeature;

/**
 * Testcase class for AnonCallRejectionFeature.
 */
class AnonCallRejectionFeatureTest extends ZimbraStructTestCase
{
    public function testAnonCallRejectionFeature()
    {
        $anoncallrejection = new AnonCallRejectionFeature(true, false);
        $this->assertInstanceOf('\Zimbra\Voice\Struct\CallFeatureInfo', $anoncallrejection);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<anoncallrejection s="true" a="false" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $anoncallrejection);

        $array = [
            'anoncallrejection' => [
                's' => true,
                'a' => false,
            ],
        ];
        $this->assertEquals($array, $anoncallrejection->toArray());
    }
}
