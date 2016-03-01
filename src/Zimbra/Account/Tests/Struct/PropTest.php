<?php

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Account\Tests\ZimbraAccountTestCase;
use Zimbra\Account\Struct\Prop;

/**
 * Testcase class for Prop.
 */
class PropTest extends ZimbraAccountTestCase
{
    public function testProp()
    {
        $zimlet = $this->faker->word;
        $name = $this->faker->word;
        $value = $this->faker->word;

        $prop = new Prop($zimlet, $name, $value);
        $this->assertSame($zimlet, $prop->getZimlet());
        $this->assertSame($name, $prop->getName());
        $this->assertSame($value, $prop->getValue());

        $prop->setZimlet($zimlet)
             ->setName($name);
        $this->assertSame($zimlet, $prop->getZimlet());
        $this->assertSame($name, $prop->getName());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<prop zimlet="' . $zimlet . '" name="' . $name . '">'  .$value . '</prop>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $prop);

        $array = [
            'prop' => [
                'zimlet' => $zimlet,
                'name' => $name,
                '_content' => $value,
            ],
        ];
        $this->assertEquals($array, $prop->toArray());
    }
}
