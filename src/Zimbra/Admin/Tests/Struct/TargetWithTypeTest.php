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

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<target type="' . $type . '">' . $value . '</target>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($target, 'xml'));
        $this->assertEquals($target, $this->serializer->deserialize($xml, TargetWithType::class, 'xml'));

        $json = json_encode([
            'type' => $type,
            '_content' => $value,
        ]);
        $this->assertSame($json, $this->serializer->serialize($target, 'json'));
        $this->assertEquals($target, $this->serializer->deserialize($json, TargetWithType::class, 'json'));
    }
}
