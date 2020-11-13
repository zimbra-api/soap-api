<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use JMS\Serializer\Annotation\XmlRoot;
use Zimbra\Admin\Struct\AdminObjectInfo;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AdminObjectInfo.
 */
class AdminObjectInfoTest extends ZimbraStructTestCase
{
    public function testAdminObjectInfo()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;

        $key1 = $this->faker->word;
        $value1 = $this->faker->word;
        $key2 = $this->faker->word;
        $value2 = $this->faker->word;

        $attr1 = new Attr($key1, $value1);
        $attr2 = new Attr($key2, $value2);

        $stub = new StubAdminObjectInfo($name, $id, [$attr1]);
        $this->assertSame($name, $stub->getName());
        $this->assertSame($id, $stub->getId());
        $this->assertSame([$attr1], $stub->getAttrList());

        $stub = new StubAdminObjectInfo('', '');
        $stub->setName($name)
             ->setId($id)
             ->setAttrList([$attr1])
             ->addAttr($attr2);
        $this->assertSame($name, $stub->getName());
        $this->assertSame($id, $stub->getId());
        $this->assertSame([$attr1, $attr2], $stub->getAttrList());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<stub name="' . $name . '" id="' . $id . '">'
                . '<a n="' . $key1 . '">' . $value1 . '</a>'
                . '<a n="' . $key2 . '">' . $value2 . '</a>'
            . '</stub>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($stub, 'xml'));
        $this->assertEquals($stub, $this->serializer->deserialize($xml, StubAdminObjectInfo::class, 'xml'));

        $json = json_encode([
            'name' => $name,
            'id' => $id,
            'a' => [
                [
                    'n' => $key1,
                    '_content' => $value1,
                ],
                [
                    'n' => $key2,
                    '_content' => $value2,
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($stub, 'json'));
        $this->assertEquals($stub, $this->serializer->deserialize($json, StubAdminObjectInfo::class, 'json'));
    }
}

/**
 * @XmlRoot(name="stub")
 */
class StubAdminObjectInfo extends AdminObjectInfo
{
}
