<?php declare(strict_types=1);

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
        $right = new RightModifierInfo($value, FALSE, TRUE, TRUE, FALSE);
        $this->assertSame($value, $right->getValue());
        $this->assertFalse($right->getDeny());
        $this->assertTrue($right->getCanDelegate());
        $this->assertTrue($right->getDisinheritSubGroups());
        $this->assertFalse($right->getSubDomain());

        $right = new RightModifierInfo();
        $right->setValue($value)
              ->setDeny(TRUE)
              ->setCanDelegate(FALSE)
              ->setDisinheritSubGroups(FALSE)
              ->setSubDomain(TRUE);
        $this->assertSame($value, $right->getValue());
        $this->assertTrue($right->getDeny());
        $this->assertFalse($right->getCanDelegate());
        $this->assertFalse($right->getDisinheritSubGroups());
        $this->assertTrue($right->getSubDomain());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<right deny="true" canDelegate="false" disinheritSubGroups="false" subDomain="true">' . $value . '</right>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($right, 'xml'));
        $this->assertEquals($right, $this->serializer->deserialize($xml, RightModifierInfo::class, 'xml'));

        $json = json_encode([
            '_content' => $value,
            'deny' => TRUE,
            'canDelegate' => FALSE,
            'disinheritSubGroups' => FALSE,
            'subDomain' => TRUE,
        ]);
        $this->assertSame($json, $this->serializer->serialize($right, 'json'));
        $this->assertEquals($right, $this->serializer->deserialize($json, RightModifierInfo::class, 'json'));
    }
}
