<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\TargetWithType;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for TargetWithType.
 */
class TargetWithTypeTest extends ZimbraStructTestCase
{
    public function testTargetWithType()
    {
        $type = $this->faker->word;
        $value = $this->faker->word;
        $target = new TargetWithType($type, $value);
        $this->assertSame($type, $target->getType());
        $this->assertSame($value, $target->getValue());

        $target = new TargetWithType('');
        $target->setType($type)
               ->setValue($value);
        $this->assertSame($type, $target->getType());
        $this->assertSame($value, $target->getValue());

        $xml = <<<EOT
<?xml version="1.0"?>
<target type="$type">$value</target>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($target, 'xml'));
        $this->assertEquals($target, $this->serializer->deserialize($xml, TargetWithType::class, 'xml'));

        $json = json_encode([
            'type' => $type,
            '_content' => $value,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($target, 'json'));
        $this->assertEquals($target, $this->serializer->deserialize($json, TargetWithType::class, 'json'));
    }
}
