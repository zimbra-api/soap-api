<?php

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Account\Tests\ZimbraAccountTestCase;
use Zimbra\Account\Struct\Attr;
use Zimbra\Account\Struct\Identity;

/**
 * Testcase class for Identity.
 */
class IdentityTest extends ZimbraAccountTestCase
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
        $this->assertSame([$attr1], $identity->getAttrs()->all());

        $identity->setName($name)
                 ->setId($id)
                 ->addAttr($attr2);

        $this->assertSame($name, $identity->getName());
        $this->assertSame($id, $identity->getId());
        $this->assertSame([$attr1, $attr2], $identity->getAttrs()->all());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<identity name="' . $name . '" id="' . $id . '">'
                . '<a name="' . $name . '" pd="true">' . $value . '</a>'
                . '<a name="' . $name . '" pd="false">' . $value . '</a>'
            . '</identity>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $identity);

        $array = [
            'identity' => [
                'name' => $name,
                'id' => $id,
                'a' => [
                    [
                        'name' => $name,
                        '_content' => $value,
                        'pd' => true,
                    ],
                    [
                        'name' => $name,
                        '_content' => $value,
                        'pd' => false,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $identity->toArray());
    }
}
