<?php

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Account\Struct\Prop;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for Prop.
 */
class PropTest extends ZimbraStructTestCase
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

        $prop = new Prop('', '');
        $prop->setZimlet($zimlet)
             ->setName($name)
             ->setValue($value);
        $this->assertSame($zimlet, $prop->getZimlet());
        $this->assertSame($name, $prop->getName());
        $this->assertSame($value, $prop->getValue());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<prop zimlet="' . $zimlet . '" name="' . $name . '">'  .$value . '</prop>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($prop, 'xml'));

        $prop = $this->serializer->deserialize($xml, 'Zimbra\Account\Struct\Prop', 'xml');
        $this->assertSame($zimlet, $prop->getZimlet());
        $this->assertSame($name, $prop->getName());
        $this->assertSame($value, $prop->getValue());
    }
}
