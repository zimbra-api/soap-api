<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\AdminZimletProperty;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for AdminZimletProperty.
 */
class AdminZimletPropertyTest extends ZimbraStructTestCase
{
    public function testAdminZimletProperty()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;

        $property = new AdminZimletProperty($name, $value);
        $this->assertSame($name, $property->getName());
        $this->assertSame($value, $property->getValue());

        $property = new AdminZimletProperty();
        $property->setName($name)
             ->setValue($value);
        $this->assertSame($name, $property->getName());
        $this->assertSame($value, $property->getValue());

        $xml = <<<EOT
<?xml version="1.0"?>
<property name="$name">$value</property>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($property, 'xml'));
        $this->assertEquals($property, $this->serializer->deserialize($xml, AdminZimletProperty::class, 'xml'));

        $json = json_encode([
            'name' => $name,
            '_content' => $value,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($property, 'json'));
        $this->assertEquals($property, $this->serializer->deserialize($json, AdminZimletProperty::class, 'json'));
    }
}
