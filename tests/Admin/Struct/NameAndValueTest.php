<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\NameAndValue;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for NameAndValue.
 */
class NameAndValueTest extends ZimbraTestCase
{
    public function testNameAndValue()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $nameValue = new NameAndValue($name, $value);
        $this->assertSame($name, $nameValue->getName());
        $this->assertSame($value, $nameValue->getValue());

        $nameValue = new NameAndValue('');
        $nameValue->setName($name)
            ->setValue($value);
        $this->assertSame($name, $nameValue->getName());
        $this->assertSame($value, $nameValue->getValue());

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" value="$value" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($nameValue, 'xml'));
        $this->assertEquals($nameValue, $this->serializer->deserialize($xml, NameAndValue::class, 'xml'));

        $json = json_encode([
            'name' => $name,
            'value' => $value,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($nameValue, 'json'));
        $this->assertEquals($nameValue, $this->serializer->deserialize($json, NameAndValue::class, 'json'));
    }
}
