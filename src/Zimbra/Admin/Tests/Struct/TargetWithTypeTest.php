<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\TargetWithType;

/**
 * Testcase class for TargetWithType.
 */
class TargetWithTypeTest extends ZimbraAdminTestCase
{
    public function testTargetWithType()
    {
        $type = $this->faker->word;
        $value = $this->faker->word;
        $target = new TargetWithType($type, $value);
        $this->assertSame($type, $target->getType());
        $this->assertSame($value, $target->getValue());

        $target->setType($type);
        $this->assertSame($type, $target->getType());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<target type="' . $type . '">' . $value . '</target>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $target);

        $array = [
            'target' => [
                'type' => $type,
                '_content' => $value,
            ],
        ];
        $this->assertEquals($array, $target->toArray());
    }
}
