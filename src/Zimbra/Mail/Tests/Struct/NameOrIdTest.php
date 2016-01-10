<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\NameOrId;

/**
 * Testcase class for NameOrId.
 */
class NameOrIdTest extends ZimbraMailTestCase
{
    public function testNameOrId()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;

        $nameId = new NameOrId($name, $id);
        $this->assertSame($name, $nameId->getName());
        $this->assertSame($id, $nameId->getId());

        $nameId->setName($name)
               ->setId($id);
        $this->assertSame($name, $nameId->getName());
        $this->assertSame($id, $nameId->getId());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<name name="' . $name . '" id="' . $id . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $nameId);

        $array = array(
            'name' => array(
                'name' => $name,
                'id' => $id,
            ),
        );
        $this->assertEquals($array, $nameId->toArray());
    }
}
