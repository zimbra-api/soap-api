<?php declare(strict_types=1);

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
        $this->assertEquals($op, $this->serializer->deserialize($xml, OpValue::class, 'xml'));

        $json = json_encode([
            'op' => '+',
            '_content' => $value,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($op, 'json'));
        $this->assertEquals($op, $this->serializer->deserialize($json, OpValue::class, 'json'));
    }
}
