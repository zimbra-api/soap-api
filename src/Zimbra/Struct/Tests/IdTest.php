<?php

namespace Zimbra\Struct\Tests;

use Zimbra\Struct\Id;

/**
 * Testcase class for Id.
 */
class IdTest extends ZimbraStructTestCase
{
    public function testId()
    {
        $value = $this->faker->word;

        $id = new Id($value);
        $this->assertSame($value, $id->getId());

        $id->setId($value);
        $this->assertSame($value, $id->getId());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<id id="' . $value . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $id);

        $array = [
            'id' => [
                'id' => $value,
            ],
        ];
        $this->assertEquals($array, $id->toArray());
    }
}
