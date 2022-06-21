<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\ItemSpec;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ItemSpec.
 */
class ItemSpecTest extends ZimbraTestCase
{
    public function testItemSpec()
    {
        $id = $this->faker->uuid;
        $folder = $this->faker->uuid;
        $name = $this->faker->name;
        $path = $this->faker->word;

        $item = new ItemSpec($id, $folder, $name, $path);
        $this->assertSame($id, $item->getId());
        $this->assertSame($folder, $item->getFolder());
        $this->assertSame($name, $item->getName());
        $this->assertSame($path, $item->getPath());

        $item = new ItemSpec();
        $item->setId($id)
             ->setFolder($folder)
             ->setName($name)
             ->setPath($path);
        $this->assertSame($id, $item->getId());
        $this->assertSame($folder, $item->getFolder());
        $this->assertSame($name, $item->getName());
        $this->assertSame($path, $item->getPath());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" l="$folder" name="$name" path="$path" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($item, 'xml'));
        $this->assertEquals($item, $this->serializer->deserialize($xml, ItemSpec::class, 'xml'));

        $json = json_encode([
            'id' => $id,
            'l' => $folder,
            'name' => $name,
            'path' => $path,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($item, 'json'));
        $this->assertEquals($item, $this->serializer->deserialize($json, ItemSpec::class, 'json'));
    }
}
