<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\ItemSpec;

/**
 * Testcase class for ItemSpec.
 */
class ItemSpecTest extends ZimbraMailTestCase
{
    public function testItemSpec()
    {
        $id = $this->faker->uuid;
        $folder = $this->faker->word;
        $name = $this->faker->word;
        $path = $this->faker->word;

        $item = new ItemSpec(
            $id, $folder, $name, $path
        );
        $this->assertSame($id, $item->getId());
        $this->assertSame($folder, $item->getFolder());
        $this->assertSame($name, $item->getName());
        $this->assertSame($path, $item->getPath());

        $item->setId($id)
             ->setFolder($folder)
             ->setName($name)
             ->setPath($path);
        $this->assertSame($id, $item->getId());
        $this->assertSame($folder, $item->getFolder());
        $this->assertSame($name, $item->getName());
        $this->assertSame($path, $item->getPath());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<item id="' . $id . '" l="' . $folder . '" name="' . $name . '" path="' . $path . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $item);

        $array = array(
            'item' => array(
                'id' => $id,
                'l' => $folder,
                'name' => $name,
                'path' => $path,
            ),
        );
        $this->assertEquals($array, $item->toArray());
    }
}
