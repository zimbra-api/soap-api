<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\AdminZimletProperty;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AdminZimletProperty.
 */
class AdminZimletPropertyTest extends ZimbraTestCase
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
<result name="$name">$value</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($property, 'xml'));
        $this->assertEquals($property, $this->serializer->deserialize($xml, AdminZimletProperty::class, 'xml'));
    }
}
