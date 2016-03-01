<?php

namespace Zimbra\Struct\Tests;

use Zimbra\Struct\Base;

/**
 * Testcase class for struct base.
 */
class BaseTest extends ZimbraStructTestCase
{
    public function testBase()
    {
        $value = $this->faker->word;
        $name = $this->faker->word;

        $base = $this->getMockForAbstractClass('Zimbra\Struct\Base');
        $base->setValue($value);
        $this->assertSame($value, $base->getValue());
        $className = $base->className();

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<' . $className . '>' . $value . '</' . $className . '>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $base);

        $array = [
            $className => [
                '_content' => $value,
            ],
        ];
        $this->assertEquals($array, $base->toArray());

        $base = $this->getMockForAbstractClass('Zimbra\Struct\Base');
        $base->setProperty($name, $value);
        $this->assertSame($value, $base->getProperty($name));

        $child = $this->getMockForAbstractClass('Zimbra\Struct\Base');
        $child->setValue($value);

        $base->setChild('child', $child);
        $this->assertSame($child, $base->getChild('child'));

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<' . $className . ' ' . $name . '="' . $value . '">'
                . '<child>' . $value . '</child>'
            . '</' . $className . '>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $base);

        $array = [
            $className => [
                $name => $value,
                'child' => [
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $base->toArray());
    }
}
