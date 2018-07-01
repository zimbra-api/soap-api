<?php

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Account\Struct\Attr;
use Zimbra\Account\Struct\Identity;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for Identity.
 */
class IdentityTest extends ZimbraStructTestCase
{
    public function testIdentity()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $id = $this->faker->word;

        $attr1 = new Attr($name, $value, true);
        $attr2 = new Attr($name, $value, false);

        $identity = new Identity($name, $id, [$attr1]);
        $this->assertSame($name, $identity->getName());
        $this->assertSame($id, $identity->getId());
        $this->assertSame([$attr1], $identity->getAttrs());

        $identity = new Identity('');
        $identity->setName($name)
                 ->setId($id)
                 ->setAttrs([$attr1])
                 ->addAttr($attr2);
        $this->assertSame($name, $identity->getName());
        $this->assertSame($id, $identity->getId());
        $this->assertSame([$attr1, $attr2], $identity->getAttrs());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<identity name="' . $name . '" id="' . $id . '">'
                . '<a name="' . $name . '" pd="true">' . $value . '</a>'
                . '<a name="' . $name . '" pd="false">' . $value . '</a>'
            . '</identity>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($identity, 'xml'));

        $identity = $this->serializer->deserialize($xml, 'Zimbra\Account\Struct\Identity', 'xml');
        $attr1 = $identity->getAttrs()[0];
        $attr2 = $identity->getAttrs()[1];

        $this->assertSame($name, $identity->getName());
        $this->assertSame($name, $attr1->getName());
        $this->assertSame($value, $attr1->getValue());
        $this->assertTrue($attr1->getPermDenied());
        $this->assertSame($name, $attr2->getName());
        $this->assertSame($value, $attr2->getValue());
        $this->assertFalse($attr2->getPermDenied());
    }
}
