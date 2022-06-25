<?php declare(strict_types=1);

namespace Zimbra\Tests\Common\Struct;

use Zimbra\Common\Struct\{AttrsImplTrait, KeyValuePair};
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AttrsImplTrait.
 */
class AttrsImplTraitTest extends ZimbraTestCase
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

        $xml = <<<EOT
<?xml version="1.0"?>
<result>
    <a n="$key1">$value1</a>
    <a n="$key2">$value2</a>
    <a n="$key3">$value3</a>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($attrs, 'xml'));
        $this->assertEquals($attrs, $this->serializer->deserialize($xml, AttrsImplImp::class, 'xml'));
    }
}

class AttrsImplImp
{
    use AttrsImplTrait;

    public function __construct(array $attrs = [])
    {
        $this->setAttrs($attrs);
    }
}
