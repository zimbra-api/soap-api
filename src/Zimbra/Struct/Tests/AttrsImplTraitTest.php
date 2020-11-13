<?php declare(strict_types=1);

namespace Zimbra\Struct\Tests;

use JMS\Serializer\Annotation\XmlRoot;
use Zimbra\Struct\{AttrsImplTrait, KeyValuePair};

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
        $this->assertEquals($attrs, $this->serializer->deserialize($xml, AttrsImplImp::class, 'xml'));

        $json = json_encode([
            'a' => [
                [
                    'n' => $key1,
                    '_content' => $value1,
                ],
                [
                    'n' => $key2,
                    '_content' => $value2,
                ],
                [
                    'n' => $key3,
                    '_content' => $value3,
                ],
            ]
        ]);
        $this->assertSame($json, $this->serializer->serialize($attrs, 'json'));
        $this->assertEquals($attrs, $this->serializer->deserialize($json, AttrsImplImp::class, 'json'));
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
