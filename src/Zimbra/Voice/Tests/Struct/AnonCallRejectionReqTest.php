<?php

namespace Zimbra\Struct\Tests;

use Zimbra\Voice\Struct\AnonCallRejectionReq;

/**
 * Testcase class for AnonCallRejectionReq.
 */
class AnonCallRejectionReqTest extends ZimbraStructTestCase
{
    public function testAnonCallRejectionReq()
    {
        $anoncallrejection = new AnonCallRejectionReq();
        $this->assertInstanceOf('\Zimbra\Voice\Struct\CallFeatureReq', $anoncallrejection);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<anoncallrejection />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $anoncallrejection);

        $array = [
            'anoncallrejection' => [],
        ];
        $this->assertEquals($array, $anoncallrejection->toArray());
    }
}
