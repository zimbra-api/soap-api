<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\TargetWithType;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for TargetWithType.
 */
class TargetWithTypeTest extends ZimbraTestCase
{
    public function testTargetWithType()
    {
        $type = $this->faker->word;
        $value = $this->faker->word;
        $target = new TargetWithType($type, $value);
        $this->assertSame($type, $target->getType());
        $this->assertSame($value, $target->getValue());

        $target = new TargetWithType();
        $target->setType($type)
               ->setValue($value);
        $this->assertSame($type, $target->getType());
        $this->assertSame($value, $target->getValue());

        $xml = <<<EOT
<?xml version="1.0"?>
<result type="$type">$value</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($target, 'xml'));
        $this->assertEquals($target, $this->serializer->deserialize($xml, TargetWithType::class, 'xml'));
    }
}
