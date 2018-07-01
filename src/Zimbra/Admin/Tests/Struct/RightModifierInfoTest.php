<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\RightModifierInfo;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for RightModifierInfo.
 */
class RightModifierInfoTest extends ZimbraStructTestCase
{
    public function testRightModifierInfo()
    {
        $value = $this->faker->word;
        $right = new RightModifierInfo($value, false, true, true, false);
        $this->assertSame($value, $right->getValue());
        $this->assertFalse($right->getDeny());
        $this->assertTrue($right->getCanDelegate());
        $this->assertTrue($right->getDisinheritSubGroups());
        $this->assertFalse($right->getSubDomain());

        $right = new RightModifierInfo();
        $right->setValue($value)
              ->setDeny(true)
              ->setCanDelegate(false)
              ->setDisinheritSubGroups(false)
              ->setSubDomain(true);
        $this->assertSame($value, $right->getValue());
        $this->assertTrue($right->getDeny());
        $this->assertFalse($right->getCanDelegate());
        $this->assertFalse($right->getDisinheritSubGroups());
        $this->assertTrue($right->getSubDomain());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<right deny="true" canDelegate="false" disinheritSubGroups="false" subDomain="true">' . $value . '</right>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($right, 'xml'));

        $right = $this->serializer->deserialize($xml, 'Zimbra\Admin\Struct\RightModifierInfo', 'xml');
        $this->assertSame($value, $right->getValue());
        $this->assertTrue($right->getDeny());
        $this->assertFalse($right->getCanDelegate());
        $this->assertFalse($right->getDisinheritSubGroups());
        $this->assertTrue($right->getSubDomain());
    }
}
