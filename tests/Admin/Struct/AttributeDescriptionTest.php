<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\AttributeDescription;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AttributeDescription.
 */
class AttributeDescriptionTest extends ZimbraTestCase
{
    public function testAttributeDescription()
    {
        $name = $this->faker->word;
        $description = $this->faker->word;

        $attr = new AttributeDescription($name, $description);
        $this->assertSame($name, $attr->getName());
        $this->assertSame($description, $attr->getDescription());

        $attr = new AttributeDescription('', '');
        $attr->setName($name)
            ->setDescription($description);
        $this->assertSame($name, $attr->getName());
        $this->assertSame($description, $attr->getDescription());

        $xml = <<<EOT
<?xml version="1.0"?>
<result n="$name" desc="$description"/>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($attr, 'xml'));
        $this->assertEquals($attr, $this->serializer->deserialize($xml, AttributeDescription::class, 'xml'));

        $json = json_encode([
            'n' => $name,
            'desc' => $description,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($attr, 'json'));
        $this->assertEquals($attr, $this->serializer->deserialize($json, AttributeDescription::class, 'json'));
    }
}
