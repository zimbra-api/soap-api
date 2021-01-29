<?php declare(strict_types=1);

namespace Zimbra\Tests\Struct;

use Zimbra\Struct\OpValue;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for OpValue.
 */
class OpValueTest extends ZimbraTestCase
{
    public function testOpValue()
    {
        $value = $this->faker->word;

        $op = new OpValue('-', $value);
        $this->assertSame('-', $op->getOp());
        $this->assertSame($value, $op->getValue());

        $op->setOp('+');
        $this->assertSame('+', $op->getOp());

        $xml = <<<EOT
<?xml version="1.0"?>
<addr op="+">$value</addr>
EOT;
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
