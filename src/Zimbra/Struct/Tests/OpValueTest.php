<?php

namespace Zimbra\Struct\Tests;

use Zimbra\Struct\OpValue;

/**
 * Testcase class for OpValue.
 */
class OpValueTest extends ZimbraStructTestCase
{
    public function testOpValue()
    {
        $value = $this->faker->word;

        $op = new OpValue('-', $value);
        $this->assertSame('-', $op->getOp());
        $this->assertSame($value, $op->getValue());

        $op->setOp('+');
        $this->assertSame('+', $op->getOp());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<addr op="+">' . $value . '</addr>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($op, 'xml'));

        $op = $this->serializer->deserialize($xml, 'Zimbra\Struct\OpValue', 'xml');
        $this->assertSame('+', $op->getOp());
        $this->assertSame($value, $op->getValue());
    }
}
