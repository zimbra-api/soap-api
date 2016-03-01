<?php

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Account\Tests\ZimbraAccountTestCase;
use Zimbra\Account\Struct\Right;

/**
 * Testcase class for Right.
 */
class RightTest extends ZimbraAccountTestCase
{
    public function testRight()
    {
        $name = $this->faker->word;
        $right = new Right($name);
        $this->assertSame($name, $right->getRight());

        $right->setRight($name);
        $this->assertSame($name, $right->getRight());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ace right="' . $name . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $right);

        $array = [
            'ace' => [
                'right' => $name,
            ],
        ];
        $this->assertEquals($array, $right->toArray());
    }
}
