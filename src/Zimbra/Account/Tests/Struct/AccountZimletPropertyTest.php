<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Account\Struct\AccountZimletProperty;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AccountZimletProperty.
 */
class AccountZimletPropertyTest extends ZimbraStructTestCase
{
    public function testAccountZimletProperty()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;

        $property = new AccountZimletProperty($name, $value);
        $this->assertSame($name, $property->getName());
        $this->assertSame($value, $property->getValue());

        $property = new AccountZimletProperty();
        $property->setName($name)
             ->setValue($value);
        $this->assertSame($name, $property->getName());
        $this->assertSame($value, $property->getValue());

        $xml = <<<EOT
<?xml version="1.0"?>
<property name="$name">$value</property>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($property, 'xml'));
        $this->assertEquals($property, $this->serializer->deserialize($xml, AccountZimletProperty::class, 'xml'));

        $json = json_encode([
            'name' => $name,
            '_content' => $value,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($property, 'json'));
        $this->assertEquals($property, $this->serializer->deserialize($json, AccountZimletProperty::class, 'json'));
    }
}
