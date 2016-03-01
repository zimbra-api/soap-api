<?php

namespace Zimbra\Struct\Tests;

/**
 * Testcase class for CallFeatureInfo.
 */
class CallFeatureInfoTest extends ZimbraStructTestCase
{
    public function testCallFeatureInfo()
    {
        $base = $this->getMockForAbstractClass('Zimbra\Voice\Struct\CallFeatureInfo', [true, false]);
        $this->assertTrue($base->getSubscribed());
        $this->assertFalse($base->getActive());
        $base->setSubscribed(true);
        $base->setActive(false);
        $this->assertTrue($base->getSubscribed());
        $this->assertFalse($base->getActive());
    }
}
