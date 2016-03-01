<?php

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Account\Tests\ZimbraAccountTestCase;
use Zimbra\Account\Struct\Attr;

/**
 * Testcase class for Attr.
 */
class AttrTest extends ZimbraAccountTestCase
{
    public function testAttr()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;

        $attr = new Attr($name, $value, false);
        $this->assertSame($name, $attr->getName());
        $this->assertSame($value, $attr->getValue());
        $this->assertFalse($attr->getPermDenied());

        $attr->setName($name)
             ->setPermDenied(true);
        $this->assertSame($name, $attr->getName());
        $this->assertTrue($attr->getPermDenied());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<attr name="' . $name . '" pd="true">' . $value . '</attr>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $attr);

        $array = [
            'attr' => [
                'name' => $name,
                '_content' => $value,
                'pd' => true,
            ],
        ];
        $this->assertEquals($array, $attr->toArray());
    }
}
