<?php

namespace Zimbra\Struct\Tests;

use JMS\Serializer\Annotation\XmlRoot;
use Zimbra\Struct\AttrsImplTrait;
use Zimbra\Struct\Base;
use Zimbra\Struct\KeyValuePair;

/**
 * Testcase class for AttrsImplTrait.
 */
class AttrsImplTraitTest extends ZimbraStructTestCase
{
    public function testAttrsImplTrait()
    {
        $key1 = $this->faker->word;
        $value1 = $this->faker->word;
        $attr1 = new KeyValuePair($key1, $value1);

        $key2 = $this->faker->word;
        $value2 = $this->faker->word;
        $attr2 = new KeyValuePair($key2, $value2);

        $key3 = $this->faker->word;
        $value3 = $this->faker->word;
        $attr3 = new KeyValuePair($key3, $value3);

        $attrs = new AttrsImplImp([$attr1]);
        $this->assertSame([$attr1], $attrs->getAttrs());
        $attrs->setAttrs([$attr1, $attr2]);
        $this->assertSame([$attr1, $attr2], $attrs->getAttrs());
        $attrs->addAttr($attr3);
        $this->assertSame([$attr1, $attr2, $attr3], $attrs->getAttrs());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<attrs>'
                . '<a n="' . $key1 . '">' . $value1 . '</a>'
                . '<a n="' . $key2 . '">' . $value2 . '</a>'
                . '<a n="' . $key3 . '">' . $value3 . '</a>'
            . '</attrs>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($attrs, 'xml'));

        $object = $this->serializer->deserialize($xml, 'Zimbra\Struct\Tests\AttrsImplImp', 'xml');
        $attrs = [$attr1, $attr2, $attr3];
        foreach ($object->getAttrs() as $key => $attr) {
            $this->assertEquals($attrs[$key]->getKey(), $attr->getKey());
            $this->assertEquals($attrs[$key]->getValue(), $attr->getValue());
        }
    }
}

/**
 * @XmlRoot(name="attrs")
 */
class AttrsImplImp
{
    use AttrsImplTrait;

    public function __construct(array $attrs = [])
    {
        $this->setAttrs($attrs);
    }
}
