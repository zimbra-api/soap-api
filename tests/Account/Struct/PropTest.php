<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use Zimbra\Account\Struct\Prop;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for Prop.
 */
class PropTest extends ZimbraTestCase
{
    public function testProp()
    {
        $zimlet = $this->faker->word;
        $name = $this->faker->word;
        $value = $this->faker->word;

        $prop = new Prop($zimlet, $name, $value);
        $this->assertSame($zimlet, $prop->getZimlet());
        $this->assertSame($name, $prop->getName());
        $this->assertSame($value, $prop->getValue());

        $prop = new Prop();
        $prop->setZimlet($zimlet)
             ->setName($name)
             ->setValue($value);
        $this->assertSame($zimlet, $prop->getZimlet());
        $this->assertSame($name, $prop->getName());
        $this->assertSame($value, $prop->getValue());

        $xml = <<<EOT
<?xml version="1.0"?>
<result zimlet="$zimlet" name="$name">$value</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($prop, 'xml'));
        $this->assertEquals($prop, $this->serializer->deserialize($xml, Prop::class, 'xml'));
    }
}
