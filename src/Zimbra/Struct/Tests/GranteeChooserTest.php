<?php

namespace Zimbra\Struct\Tests;

use Zimbra\Enum\AccountBy;
use Zimbra\Struct\GranteeChooser;

/**
 * Testcase class for GranteeChooser.
 */
class GranteeChooserTest extends ZimbraStructTestCase
{
    public function testGranteeChooser()
    {
        $type = $this->faker->word;
        $id = $this->faker->word;
        $name = $this->faker->word;

        $grantee = new GranteeChooser($type, $id, $name);
        $this->assertSame($type, $grantee->getType());
        $this->assertSame($id, $grantee->getId());
        $this->assertSame($name, $grantee->getName());

        $grantee->setType($type)
                ->setId($id)
                ->setName($name);
        $this->assertSame($type, $grantee->getType());
        $this->assertSame($id, $grantee->getId());
        $this->assertSame($name, $grantee->getName());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<grantee type="' . $type . '" id="' . $id . '" name="' . $name . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $grantee);

        $array = [
            'grantee' => [
                'type' => $type,
                'id' => $id,
                'name' => $name,
            ],
        ];
        $this->assertEquals($array, $grantee->toArray());
    }
}
