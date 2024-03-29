<?php declare(strict_types=1);

namespace Zimbra\Tests\Common\Struct;

use Zimbra\Common\Struct\OpValue;
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
<result op="+">$value</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($op, 'xml'));
        $this->assertEquals($op, $this->serializer->deserialize($xml, OpValue::class, 'xml'));
    }
}
