<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\TypeIdName;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for TypeIdName.
 */
class TypeIdNameTest extends ZimbraTestCase
{
    public function testTypeIdName()
    {
        $type = $this->faker->word;
        $name = $this->faker->word;
        $id = $this->faker->uuid;

        $target = new TypeIdName(
            $type, $id, $name
        );
        $this->assertSame($type, $target->getType());
        $this->assertSame($id, $target->getId());
        $this->assertSame($name, $target->getName());

        $target = new TypeIdName('', '', '');
        $target->setId($id)
               ->setName($name)
               ->setType($type);
        $this->assertSame($type, $target->getType());
        $this->assertSame($id, $target->getId());
        $this->assertSame($name, $target->getName());

        $xml = <<<EOT
<?xml version="1.0"?>
<result type="$type" id="$id" name="$name" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($target, 'xml'));
        $this->assertEquals($target, $this->serializer->deserialize($xml, TypeIdName::class, 'xml'));

        $json = json_encode([
            'type' => $type,
            'id' => $id,
            'name' => $name,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($target, 'json'));
        $this->assertEquals($target, $this->serializer->deserialize($json, TypeIdName::class, 'json'));
    }
}
