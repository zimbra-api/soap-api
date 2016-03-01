<?php

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Account\Tests\ZimbraAccountTestCase;
use Zimbra\Account\Struct\NameId;

/**
 * Testcase class for NameId.
 */
class NameIdTest extends ZimbraAccountTestCase
{
    public function testNameId()
    {
        $name = $this->faker->word;
        $id = $this->faker->word;

        $nameId = new NameId($name, $id);
        $this->assertSame($name, $nameId->getName());
        $this->assertSame($id, $nameId->getId());

        $nameId->setName($name)
               ->setId($id);
        $this->assertSame($name, $nameId->getName());
        $this->assertSame($id, $nameId->getId());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<nameid name="' . $name . '" id="' . $id . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $nameId);

        $array = [
            'nameid' => [
                'name' => $name,
                'id' => $id,
            ],
        ];
        $this->assertEquals($array, $nameId->toArray());
    }
}
