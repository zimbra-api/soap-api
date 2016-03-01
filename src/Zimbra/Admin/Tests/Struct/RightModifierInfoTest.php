<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\RightModifierInfo;

/**
 * Testcase class for RightModifierInfo.
 */
class RightModifierInfoTest extends ZimbraAdminTestCase
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

        $right->setDeny(true)
              ->setCanDelegate(false)
              ->setDisinheritSubGroups(false)
              ->setSubDomain(true);
        $this->assertTrue($right->getDeny());
        $this->assertFalse($right->getCanDelegate());
        $this->assertFalse($right->getDisinheritSubGroups());
        $this->assertTrue($right->getSubDomain());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<right deny="true" canDelegate="false" disinheritSubGroups="false" subDomain="true">' . $value . '</right>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $right);

        $array = [
            'right' => [
                'deny' => true,
                'canDelegate' => false,
                'disinheritSubGroups' => false,
                'subDomain' => true,
                '_content' => $value,
            ],
        ];
        $this->assertEquals($array, $right->toArray());
    }
}
